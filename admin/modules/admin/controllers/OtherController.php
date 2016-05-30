<?php

namespace app\modules\admin\controllers;

class OtherController extends Controller
{

    // 头部导航信息
    public function actionTop()
    {
        return $this->render('blankpage');
    }

    // 404错误信息
    public function actionError404()
    {
        return $this->render('error404');
    }

    // 500错误信息
    public function actionError500()
    {
        return $this->render('error500');
    }

    // 空白页
    public function actionBlankpage()
    {
        return $this->render('blankpage');
    }
}
