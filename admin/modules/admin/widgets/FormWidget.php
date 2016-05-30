<?php
// 定义命名空间
namespace app\modules\admin\widgets;

// 引入需要的类
use yii\base\Widget;
use yii\helpers\Html;

class FormWidget extends Widget
{
    public $attributes;
    public $labels;
    public $isSubmit;

    // 初始化定义
    public function init()
    {
        parent::init();
        if ($this->isSubmit === null)
        {
            $this->isSubmit = false;
        }
    }

    public function run()
    {
        return $this->render('form', [
            'attributes' => $this->attributes,
            'labels'     => $this->labels,
            'isSubmit'   => $this->isSubmit,
        ]);
    }
}