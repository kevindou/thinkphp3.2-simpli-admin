<?php

namespace backend\controllers;

use backend\models\Admin;
use Yii;
/**
 * file: AdminController.php
 * desc: 管理员操作控制器
 * user: liujinxing
 * date: 2016-0-21
 */
class AdminController extends Controller
{
    // 搜索配置
    public function where($params)
    {
        $where  = [];
        $intUid = (int)Yii::$app->user->id;
        if ($intUid != 1)
        {
            $where = [['or', ['id' => $intUid], ['create_id' => $intUid]]];
        }

        return [
            'id'       => '=',
            'username' => 'like',
            'email'    => 'like',
            'where'    => $where,
        ];
    }

    // 首页显示
    public function actionIndex()
    {
        // 查询用户数据
        return $this->render('index', [
            'roles'  => Admin::getArrayRole(),      // 用户角色
            'status' => Admin::getArrayStatus(),    // 状态
        ]);
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
                    $this->arrError['code'] = 206;
                    if ($model->load(['params' => Yii::$app->request->post()], 'params'))
                    {
                        if ($model->save())
                        {
                            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);
                            $this->arrError = [
                                'code' => 0,
                                'data' => $model,
                            ];
                        }

                        // 返回错误信息
                        if ($this->arrError['code'] !== 0) $this->arrError['msg'] = $model->getErrorString();
                    }
                    break;
                case 'update':
                    $id  = (int)$array['id'];
                    $uid = Yii::$app->user->id;
                    if ($id)
                    {
                        $model = Admin::findOne($id);
                        if ($model)
                        {
                            // 判断权限 管理员可以操作所有权限,其他用户只能修改自己添加的用户
                            $this->arrError['code'] = 216;
                            if ($uid == 1 || ($model->create_id == $uid || $model->id == $uid))
                            {
                                $model->setScenario('admin-update');
                                $this->arrError['code'] = 206;
                                if ($model->load(['params' => Yii::$app->request->post()], 'params'))
                                {
                                    if ($model->save())
                                    {
                                        Yii::$app->authManager->revokeAll($id);
                                        Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
                                        $this->arrError = [
                                            'code'   => 0,
                                            'data'   => $model,
                                        ];
                                    }

                                    // 返回错误信息
                                    if ($this->arrError['code'] !== 0) $this->arrError['msg'] = $model->getErrorString();
                                }
                            }
                        }
                    }
                    break;

                case 'delete':
                    $id = (int)$array['id'];
                    // 不能删除管理员
                    if ($id !== 1)
                    {
                        // 需要有删除管理员的权限
                        $this->arrError['code'] = 216;
                        if (Yii::$app->user->can('deleteAdmin'))
                        {
                            $this->arrError['code'] = 207;
                            $arrUser = Admin::findOne($id);
                            if ($arrUser && $arrUser->delete())
                            {
                                // 移出权限
                                Yii::$app->authManager->revokeAll($id);
                                $this->arrError = [
                                    'code' => 0,
                                    'data' => $arrUser,
                                ];
                            }
                        }
                    }
                    break;
            }
        }

        return $this->returnAjax();
    }

    // 我的信息
    public function actionView()
    {
        return $this->render('view', ['user' => Yii::$app->getUser()->identity]);
    }
}
