<?php
namespace app\modules\admin\models;

use Yii;

/**
 * Class     Model
 * @package  app\modules\admin\models
 * desc :    所有Model的公共类
 */
class Model extends \yii\db\ActiveRecord
{
    // jqGrid
    // public $arrColModel  = array();                  // 表格列的属性 ['name' => 'id',   'index' => 'id', 'width' => 60, 'sorttype'   => 'int', 'editable' => true],

    // 显示表格列的属性
    public function showColModel(){ return [];}
    public function showDetail(){ return [];}

    public function getAlias(){ return []; }

    // jquery.dataTables 表格中添加操作信息
    public function getOperate()
    {
        return [
            'search-plus' => ['title' => '查看', 'class' => 'btn-success me-info', 'span-class' => 'blue', 'a-class' => 'me-info'],
            'pencil'      => ['title' => '编辑', 'class' => 'btn-info me-edit', 'span-class' => 'green', 'a-class' => 'me-edit'],
            'trash-o'     => ['title' => '删除', 'class' => 'btn-danger me-delete', 'span-class' => 'red', 'a-class' => 'me-delete'],
        ];
    }

    // jquery.dataTable 表格类信息
    public function showTableAttributes(){ return array();}

    // 表单字段信息
    public function showFormAttributes(){ return array();}

    // 返回错误信息
    public function getError()
    {
        $str_msg = '';
        if ( ! empty($this->errors))
        {
            // 错误为一个数组
            foreach ($this->errors as $value)
            {
                if (is_array($value))
                {
                    foreach ($value as $val) $str_msg .= $val;
                }
            }
        }

        return $str_msg;
    }
}
