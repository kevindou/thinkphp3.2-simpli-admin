<?php
// 定义命名空间
namespace app\modules\admin\widgets;

// 引入需要的类
use yii\base\Widget;

class OperateWidget extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('operate', [
            'model' => $this->model,
        ]);
    }
}