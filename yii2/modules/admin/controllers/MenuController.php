<?php

namespace app\modules\admin\controllers;
use app\modules\admin\models\Menu;
use yii\data\Pagination;

class MenuController extends Controller
{
    public $title = '导航栏信息';

    // 获取模型对象
    public function getModel($find = false)
    {
        return new Menu;
    }

    // 显示之前的数据处理
    public function beforeShow(&$value, $model)
    {
        $arrPids    = [];
        foreach ($value as $val) $arrPids[] = $val['parent_id'];
        $arrCate    = $model->find()->select(['id', 'menu_name'])->where(['and', ['in', 'id', $arrPids]])->indexBy('id')->all();
        $arrCate[0] = ['menu_name' => '上级导航'];

        foreach ($value as &$val)
        {
            $val['str_pid']     = $arrCate[$val['parent_id']]['menu_name'];
            $val['str_status']  = \Yii::$app->params['status'][$val['status']];
            $arrIcons           = explode('-', $val['icons']);
            $val['str_icons']   = "<i class=\"menu-icon {$arrIcons[0]} {$val['icons']}\"></i>";
            $val['create_time'] = date('Y-m-d H:i:s', $val['create_time']);
            $val['update_time'] = date('Y-m-d H:i:s', $val['update_time']);
        }
    }
}
