<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2015/12/31
 * Time: 18:03
 */
namespace Admin\Model;
use Admin\Common\JqGridModel;

/**
 * Class UsersModel
 * @package Admin\Model
 * desc: 用户信息模型
 */
class UsersModel extends jqGridModel
{
    // 显示详情信息
    public $attribute = array(
        'id'         => '标识ID',
        'projectid'  => '项目名称',
        'agentid'    => '平台商',
        'username'   => '登录名',
        'password'   => '明文密码',
        'encrypt'    => '加密密码',
        'suid'       => '游戏账号ID',
        'status'     => '玩家状态',
        'lastTime'   => '用户最后登录的时间',
        'lastIp'     => '最后登录的IP',
        'createId'   => '创建者',
        'createTime' => '用户创建的时间',
        'updateId'   => '修改用户信息者ID',
        'updateTime' => '修改时间',
    );

    // 定义表格列信息
    public $arrColModel = array(
        'id'         => array('width' => 60,  'editable' => false),
        'projectid'  => array('width' => 60,  'editoptions' => array('required' => true, 'number' => true)),
        'agentid'    => array('width' => 80,  'edittype' => 'select', 'editoptions' => array('required' => true, 'number' => true)),
        'username'   => array('width' => 80,  'editoptions' => array('required' => true, 'minlength' => 2, 'maxlength' => 20)),
        'suid'       => array('width' => 120, 'editoptions' => array('rangelength' => '[5, 20]')),
        'status'     => array('width' => 80,  'edittype' => 'select', 'editoptions' => array('value' => '1:启用;0:停用'), 'unformat' => 'aceSwitch'),
        'createTime' => array('width' => 150, 'editable' => false),
    );

    // 数据验证
    protected $_validate = array(
        array('projectid', 'require', '项目ID必须填写', 1),
        array('projectid', 'number', '项目ID必须为数字', 1),
        array('agentid', 'require', '平台ID必须填写', 1),
        array('agentid', 'number', '平台ID必须位数字', 1),
        array('username', 'require', '用户名称不能为空', 1),
        array('username', '/\w{2,20}/', '用户名称必须为2到20位字符', 1),
        array('username', '', '用户名称必须为2到20位字符', 1, 'unique', 1),
        array('suid', '/\w{2,20}/', '用户游戏ID必须为2到20位字符', 2),
        array('status', 'number', '状态必须为数字', 1),
    );

    // 数据新增之前
    public function _before_insert(&$data,$options)
    {
        unset($data['id']);
        $data['password'] = 123;
        $data['encrypt']  = md5(123);
        $data['createTime'] = $data['updateTime'] = $data['lastTime'] = time();
        $data['createId']   = $data['updateId'] = 1;
        if (empty($data['suid'])) $data['suid'] = 'gt_user'.date('YmdHis').mt_rand(10000, 99999);
    }
}