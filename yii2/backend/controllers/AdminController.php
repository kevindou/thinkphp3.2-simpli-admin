<?php

namespace backend\controllers;

use backend\models\Admin;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    // 搜索配置
    public function where($params)
    {
        return [
            'id'       => '=',
            'username' => '=',
            'email'    => '=',
        ];
    }

    // 首页显示
    public function actionIndex()
    {
        // 查询用户数据
        $roles = Admin::getArrayRole();
        Yii::$app->view->params['roles']  = $roles;
        Yii::$app->view->params['status'] = Admin::getArrayStatus();
        return $this->render('index');
    }

    // 返回model
    public function getModel() { return new Admin();}

    // 重新新增和修改的方法
    public function actionUpdate()
    {
        // 接收参数
        $request = Yii::$app->request;           // 请求信息
        $array   = $request->post();             // 请求参数
        $action  = $request->post('actionType'); // 操作类型

        // 判断数据的有效性
        if ($action && $array)
        {
            switch ($action)
            {
                case 'insert':
                    $model = new Admin(['scenario' => 'admin-create']);
                    $this->arrError['msg'] = '服务器繁忙, 请稍候再试...';
                    if ($model->load(['params' => Yii::$app->request->post()], 'params'))
                    {
                        if ($model->save())
                        {
                            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);
                            $this->arrError['status'] = 1;
                        }

                        // 返回错误信息
                        if ($this->arrError['status'] != 0) $this->arrError['msg'] = $model->getErrorString();
                    }
                    break;
                case 'update':
                    $id  = (int)$array['id'];
                    $uid = Yii::$app->user->id;
                    if ($id)
                    {
                        $model = $this->findModel($id);
                        if ($model)
                        {
                            // 判断权限 管理员可以操作所有权限,其他用户只能修改自己添加的用户
                            $this->arrError['msg'] = '对不起，您现在还没获得该操作的权限!';
                            if ($uid == 1 || $model->created_id == $uid)
                            {
                                $model->setScenario('admin-update');
                                $this->arrError['msg'] = '服务器繁忙, 请稍候再试...';
                                if ($model->load(['params' => Yii::$app->request->post()], 'params'))
                                {
                                    if ($model->save())
                                    {
                                        Yii::$app->authManager->revokeAll($id);
                                        Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
                                        $this->arrError['status'] = 1;
                                    }

                                    // 返回错误信息
                                    if ($this->arrError['status'] != 1) $this->arrError['msg'] = $model->getErrorString();
                                }
                            }
                        }
                    }
                    break;

                case 'delete':
                    $id = (int)$array['id'];
                    if ($id !== 1)
                    {
                        if ($this->findModel($id)->delete())
                        {
                            // 移出权限
                            Yii::$app->authManager->revokeAll($id);
                            $this->arrError['status'] = 1;
                        }
                    }
                    break;
            }
        }

        return $this->returnAjax();
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
