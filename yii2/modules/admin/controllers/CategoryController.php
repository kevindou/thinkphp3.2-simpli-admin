<?php

namespace app\modules\admin\controllers;
use app\modules\admin\models\Category;
use yii\data\Pagination;

class CategoryController extends Controller
{
    public $title = '文章分类信息';

    // 获取模型对象
    public function getModel($find = false)
    {
        return new Category;
    }

    // 显示之前的数据处理
    // 显示之前的数据处理
    public function beforeShow(&$value, $model)
    {
        $arrPids    = [];
        foreach ($value as $val) $arrPids[] = $val['pid'];
        $arrCate    = $model->find()->select(['id', 'cate_name'])->where(['and', ['in', 'id', $arrPids ]])->indexBy('id')->asArray()->all();
        $arrCate[0] = ['cate_name' => '父级分类'];
        foreach ($value as &$val)
        {
            $val['create_time']   = date('Y-m-d H:i:s', $val['create_time']);
            $val['str_pid']       = $arrCate[$val['pid']]['cate_name'];
            $val['str_status']    = \Yii::$app->params['status'][$val['status']];
            $val['str_recommend'] = \Yii::$app->params['recommend'][$val['recommend']];
            $val['update_time']   = date('Y-m-d H:i:s', $val['update_time']);
        }
    }
}
