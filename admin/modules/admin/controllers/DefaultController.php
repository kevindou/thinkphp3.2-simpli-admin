<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Admin;

class DefaultController extends Controller
{
    // 首页登录
    public function actionIndex()
    {
        // 判断是否已经登录
        if (\Yii::$app->session->get(\Yii::$app->params['session_admin']))
        {
            return $this->redirect(['admin/index']);
        }

        $this->layout = false;  // 不使用布局
        return $this->render('index');
    }

    // 后台用户登录
    public function actionLogin()
    {
        // 初始化返回
        $int_status = 0;
        $str_msg    = '提交数据为空';
        $request    = \Yii::$app->request;

        // 验证ajax提交和数据不为空
        if ($request->isAjax && ! empty($request->post()))
        {
            // 实例化模型对象
            $model = new Admin;
            $model->scenario   = 'login';
            $model->attributes = \Yii::$app->request->post();
            $is_validate       = $model->validate();
            $str_msg           = $model->getError();

            // 验证通过
            if ($is_validate)
            {
                // 查询数据
                $arr_user = Admin::findOne([
                    'username' => $model->username,
                    'password' => sha1($model->password),
                ]);

                $str_msg  = '用户名或者密码错误';
                if ($arr_user)
                {
                    // 判断是否审核管理员
                    $str_msg = '还没有被管理员审核通过,不能进行登录';
                    if ($arr_user->status == 1)
                    {
                        $arr_user->last_time = time();
                        $arr_user->last_ip   = $request->userIP;

                        // 执行修改
                        $is_true             = $arr_user->save();
                        $str_msg             = '服务器繁忙,请稍候再试...';

                        // 登录成功
                        if ($is_true)
                        {
                            $session   = \Yii::$app->session;
                            $session->set(\Yii::$app->params['session_admin'], $arr_user);
                            $int_status = 1;
                            $str_msg    = '登录成功正在为您跳转到首页,请稍候...';
                        }
                    }
                }
            }
        }

        // ajax返回
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'status' => $int_status,
            'msg'    => $str_msg,
        ];
    }

    // 后台用户退出页面
    public function actionLogout()
    {
        \Yii::$app->session->remove(\Yii::$app->params['session_admin']);
        return $this->redirect(['default/index']);
    }
}
