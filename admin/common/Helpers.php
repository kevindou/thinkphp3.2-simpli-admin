<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2016/2/26
 * Time: 11:25
 */
namespace app\common;
use yii\helpers\Html;


class Helpers
{
    /**
     * actTableCol() jquery.dataTable   生成列信息
     * @param array $arrTableAttributes 列字段信息
     * @param array $options            其他添加参数
     * @return array 返回列和搜索信息
     */
    public static function aceTableCol(array $arrTableAttributes, $attributes = array())
    {
        // 初始化定义
        $int_index      = 0;
        $arr_attributes = [
            'aoColumns' => [],
            'strSearch' => '',
        ];

        foreach ($arrTableAttributes as $key => $value)
        {
            $value['title'] = isset($value['title']) ? $value['title'] : $attributes[$key];
            // 判断是否添加搜索条件
            if (isset($value['search']) && ! empty($value['search']))
            {

                // 默认赋值
                $value['search']['type']             = isset($value['search']['type']) ? $value['search']['type'] : 'text';
                $value['search']['options']          = isset($value['search']['options']) ? $value['search']['options'] : [];
                $value['search']['options']['id']    = 'm-search-'.$key;
                $value['search']['options']['index'] = $int_index;
                $value['search']['options']['class'] = 'me-search';

                // 判断类型
                switch ($value['search']['type'])
                {
                    case 'text':
                        $input = Html::input('text', $key, '', $value['search']['options']);
                        break;
                    case 'select':
                        $value['search']['value'][-100] = '请选择';
                        ksort($value['search']['value']);
                        $str_options = '';
                        foreach ($value['search']['value'] as $k => $v) $str_options .= '<option value="'.$k.'"> '.$v.' </option>';
                        $input = Html::tag('select', $str_options, $value['search']['options']);
                        break;
                }

                $arr_attributes['strSearch'] .= Html::label($value['title'] . ':' . $input, $value['search']['options']['id']);
                unset($value['search']);
            }


            // 默认赋值
            $aoColumns = array(
                'data'      => isset($value['data']) ? $value['data'] : $key,
                'sName'     => $key,
                'sTitle'    => $value['title'],
                'bSortable' => true,
            );

            // 重新覆盖
            $arr_attributes['aoColumns'][] = array_merge($aoColumns, $value);
            $int_index ++;
        }

        $arr_attributes['aoColumns'] = json_encode($arr_attributes['aoColumns']);
        return $arr_attributes;
    }
}