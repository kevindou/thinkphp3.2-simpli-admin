<?php
/**
 * file: CategoryModel.class.php
 * desc: 文章分类
 * user: liujx
 * date: 2015-11-30
 */
class CategoryModel extends CommModel
{
    public $arrEditTh = array();
    public $strLike   = 'cateName';
    // 表头字段
    public $arrShowTh = array(
        array('title' => '标识ID', 'name' => 'id', 'sort' => true),
        array('title' => '父类ID', 'name' => 'pid', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '分类名称', 'name' => 'cateName', 'sort' => true),
        array('title' => '排序', 'name' => 'sort', 'sort' => true),
//        array('title' => '路径', 'name' => 'path'),
        array('title' => '状态', 'name' => 'status', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '推荐', 'name' => 'recommend', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '创建时间', 'name' => 'createTime', 'sort' => true),
    );

    // 添加数据
    public $arrAddTh = array(
        'pid'      => array('label' => '父类ID', 'type' => 'select', 'other' => array('required' => true, 'number' => true)),
        'cateName' => array('label' => '分类名称', 'other' => array('required' => true, 'rangelength' => '[2, 12]')),
        'sort'     => array('label' => '排序', 'other' => array('required' => true, 'number' => true)),
        'status'   => array('label' => '状态', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true, 'number' => true)),
        'recommend'=> array('label' => '推荐', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true, 'number' => true)),
    );

    // 数据验证
    protected $_validate = array(
        array('pid', 'number', '父类ID必须为一个数字', 1),
        array('cateName', 'require', '分类名称不能为空', 1),
        array('cateName', '/\S{2,12}/', '分类名称必须为2到12位字符串', 1),
        array('cateName', '', '分类名称已经存在', 1, 'unique', 1),
        array('sort', 'number', '排序必须是一个数字', 1),
        array('status', 'number', '状态必须是一个数字', 1),
        array('recommend', 'number', '推荐状态必须是一个数字', 1),
    );

    // 详情信息
    public $attribute = array(
        'id'         => '分类ID',
        'pid'        => '父类ID',
        'path'       => '分类路径',
        'cateName'   => '分类名称',
        'sort'       => '分类排序',
        'status'     => '分类状态',
        'createTime' => '创建时间',
        'createId'   => '创建用户',
        'updateTime' => '修改时间',
        'updateId'   => '修改者ID',
    );
}