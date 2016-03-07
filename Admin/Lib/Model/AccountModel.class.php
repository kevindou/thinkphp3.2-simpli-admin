<?php
/**
 * file: CategoryModel.class.php
 * desc: 文章信息
 * user: liujx
 * date: 2015-11-30
 */
class AccountModel extends CommModel
{
    public $arrEditTh = array();
    public $strLike   = 'desc';

    // 表头字段
    public $arrShowTh = array(
        array('title' => '标识ID', 'name' => 'id', 'sort' => true),
        array('title' => '用户ID', 'name' => 'user_id', 'sort' => true, 'search' => array('type' => 'text')),
        array('title' => '积分', 'name' => 'account', 'sort' => true),
        array('title' => '描述', 'name' => 'desc'),
        array('title' => '创建时间', 'name' => 'create_time', 'sort' => true),
    );

    // 添加数据
    public $arrAddTh = array(
        'user_id' => array('label' => '用户ID', 'other' => array('required' => true, 'number' => true)),
        'status'  => array('label' => '使用情况', 'type' => 'radio', 'checked' => 2, 'value' => array( 1 => '增加', 2 => '减少'), 'other' => array('required' => true, 'number' => true)),
        'account' => array('label' => '积分', 'other' => array('required' => true, 'number' => true)),
        'desc'    => array('label' => '描述', 'other' => array('required' => true, 'rangelength' => '[2, 256]')),
        'id'      => array('type' => 'hidden'),
    );

    // 数据验证
    protected $_validate = array(
        array('user_id', 'require', '用户ID不能为空', 1),
        array('user_id', 'number', '用户ID必须为一个数字', 1),
        array('account', 'require', '积分不能为空', 1),
        array('account', 'number', '积分必须为一个数字', 1),
        array('desc', 'require', '描述信息不能为空', 1),
    );

    // 详情信息
    public $attribute = array(
        'id'          => '记录ID',
        'user_id'     => '用户名称',
        'account'     => '积分',
        'desc'        => '描述',
        'create_time' => '创建时间',
    );

    // 数据新增的之前操作
    protected function _before_insert(&$data,$options)
    {
        $data['create_time'] = time();
        return true;
    }
}