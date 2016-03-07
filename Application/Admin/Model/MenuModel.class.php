<?php
/**
 * file: CategoryModel.class.php
 * desc: 文章分类
 * user: liujx
 * date: 2015-11-30
 */
namespace Admin\Model;
use Admin\Common\CommonModel;
use Common\CHtml;

class MenuModel extends CommonModel
{
    public $strLike   = 'menu_name';

    // jquery.dataTable 表格类信息
    public function showTableAttributes()
    {
        return array(
            'id'              => array('title' => '标识ID', 'search' => array('type' => 'text')),
            'parent_id'       => array('title' => '上级导航', 'data' => 'str_pid'),
            'menu_name'       => array('title' => '导航名称'),
            'controller_name' => array('title' => '访问控制器'),
            'action_name'     => array('title' => '访问方法'),
            'sort'            => array('title' => '排序'),
            'status'          => array('title' => '状态', 'data' => 'str_status', 'search' => array('type' => 'select', 'value' => $this->arrStatus)),
            'create_time'     => array('title' => '创建时间'),
            'operate'         => array('title' => '操作', 'bSortable' => false, 'defaultContent' => CHtml::aceThOperates($this->defaultOperate, $this->hideButtons))
        );
    }

    // 表单字段信息
    public function showFormAttributes()
    {
        // 查询所有一级分类
        $arrParent    = CHtml::setOption($this->field('id,menu_name')->where(array('status' => 1))->select(), 'id', 'menu_name');
        $arrParent[0] = '上级导航';
        return array(
            'id'              => array('type' => 'hidden'),
            'parent_id'       => array('label' => '上级导航', 'type' => 'select', 'value' => $arrParent,'options' => array('required' => true, 'number' => true)),
            'menu_name'       => array('label' => '导航名称', 'options' => array('required' => true, 'rangelength' => '[2, 20]')),
            'icons'           => array('label' => '使用图标', 'options' => array('required' => true, 'rangelength' => '[2, 20]')),
            'controller_name' => array('label' => '访问控制器', 'options' => array('rangelength' => '[2, 20]')),
            'action_name'     => array('label' => '访问方法', 'options' => array('rangelength' => '[2, 20]')),
            'sort'            => array('label' => '排序', 'value' => 100, 'options' => array('required' => true, 'number' => true)),
            'status'          => array('label' => '状态', 'type' => 'radio', 'default' => 1, 'value' => array('停用', '启用'), 'options' => array('required' => true, 'number' => true)),
        );
    }

    // 数据验证
    protected $_validate = array(
        array('parent_id', 'number', '父类ID必须为一个数字', 1),
        array('menu_name', 'require', '导航名称不能为空', 1),
        array('menu_name', '/\S{2,20}/', '导航名称必须为2到12位字符串', 1),
        array('menu_name', '', '导航名称已经存在', 1, 'unique', 1),
        array('sort', 'number', '排序必须是一个数字', 1),
        array('status', 'number', '状态必须是一个数字', 1),
    );

    // 详情信息
    public $attribute = array(
        'id'              => '导航ID',
        'menu_name'       => '导航名称',
        'str_icons'       => '使用图标',
        'controller_name' => '访问控制器',
        'action_name'     => '访问方法',
        'str_pid'         => '上级导航',
        'sort'            => '导航排序',
        'str_status'      => '导航状态',
        'create_time'     => '创建时间',
        'create_id'       => '创建用户',
        'update_time'     => '修改时间',
        'update_id'       => '修改者ID',
    );
}