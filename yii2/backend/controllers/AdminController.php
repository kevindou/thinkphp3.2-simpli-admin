<?php

namespace backend\controllers;

use backend\models\Admin;
use Yii;
use yii\web\NotFoundHttpException;
use backend\models\Init;
use yii\helpers\ArrayHelper;
/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    // 定义查询数组
    public $search = [
        'orderBy'  => 'id',
        'search'   => 'username',
        'username' => 'like',
        'email'    => 'like',
        'role'     => '=',
    ];

    public function actionIndex()
    {
        // 查询用户数据
        $roles = Admin::getArrayRole();
        Yii::$app->view->params['roles']  = $roles;
        Yii::$app->view->params['status'] = Admin::getArrayStatus();
        $gamelist = Init::find()->all();
        if (empty($gamelist)) $gamelist = [];
        $gameids = ArrayHelper::map($gamelist, 'appid', 'appname');
        return $this->render('index',['gameids'=>$gameids]);
    }

    // 返回model
    public function getModel() { return new Admin();}

    // 查询之前添加查询条件
    public function beforeSearch(&$query)
    {
        $uid = Yii::$app->user->id;
        // 不是管理员
        if ($uid != 1) $query = $query->andFilterWhere(['created_id' => $uid])->orFilterWhere(['id' => $uid]);
        return true;
    }

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
                    if ($model->load(['params' => Yii::$app->request->post()], 'params'))
                    {
                        //var_dump($model);exit;
                        if ($model->save())
                        {
                            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);
                            $this->arrError['code'] = 0;
                        }

                        // 返回错误信息
                        if ($this->arrError['code'] != 0) $this->arrError['msg'] = $model->getErrorString();
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
                            $this->arrError['code'] = 216;
                            if ($uid == 1 || $model->created_id == $uid)
                            {
                                $model->setScenario('admin-update');
                                if ($model->load(['params' => Yii::$app->request->post()], 'params'))
                                {
                                    if ($model->save())
                                    {
                                        Yii::$app->authManager->revokeAll($id);
                                        Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
                                        $this->arrError['code'] = 0;
                                    }

                                    // 返回错误信息
                                    if ($this->arrError['code'] != 0) $this->arrError['msg'] = $model->getErrorString();
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
                            $this->arrError['code'] = 0;
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
