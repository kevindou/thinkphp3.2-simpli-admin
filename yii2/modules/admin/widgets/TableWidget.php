<?php
// 定义命名空间
namespace app\modules\admin\widgets;

// 引入需要的类
use yii\base\Widget;

class TableWidget extends Widget
{
    public $alias;
    public $attributes;

    public function run()
    {
        return $this->render('table', [
            'alias'      => $this->alias,
            'attributes' => $this->attributes,
        ]);
    }
}