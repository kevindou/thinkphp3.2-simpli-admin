<?php
/**
 * file: AgentModel.class.php
 * desc: 平台控制器
 * user: liujx
 * date: 2015-11-30
 */
class AgentModel extends CommModel
{
    public $strLike   = 'en_name,cn_name';
    public $arrEditTh = array();

    // 表头字段
    public $arrShowTh = array(
        array('title' => '标识ID', 'name' => 'id', 'sort' => true),
        array('title' => '项目ID', 'name' => 'projectId', 'sort' => true),
        array('title' => '英文名', 'name' => 'en_name'),
        array('title' => '中文名', 'name' => 'cn_name', 'sort' => true),
        array('title' => '登录密钥', 'name' => 'loginSecret', 'search' => array('type' => 'text', 'and' => 'LIKE')),
        array('title' => '充值密钥', 'name' => 'paymentSecret', 'sort' => true),
        array('title' => '接口地址', 'name' => 'apiUrl', 'sort' => true, 'search' => array('type' => 'text', 'and' => 'LIKE')),
        array('title' => '状态', 'name' => 'status', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '充值', 'name' => 'recharge_status', 'sort' => true),
    );

    // 添加数据
    public $arrAddTh = array(
        'id'            => array('label' => '标示ID', 'other' => array('required' => true, 'number' => true),),
        'projectId'     => array('label' => '项目ID', 'value' => 1, 'other' => array('required' => true, 'number' => true)),
        'en_name'       => array('label' => '英文名', 'other' => array('required' => true, 'rangelength' => '[2, 20]')),
        'cn_name'       => array('label' => '中文名', 'other' => array('required' => true, 'rangelength' => '[2, 20]')),
        'loginSecret'   => array('label' => '登录密钥', 'other' => array('required' => true, 'minlength' => 10, 'maxlength' => 10)),
        'paymentSecret' => array('label' => '充值密钥', 'other' => array('required' => true, 'minlength' => 10, 'maxlength' => 10)),
        'apiUrl'        => array('label' => '接口地址', 'other' => array('required' => true, 'url' => true)),
        'mysqlHost'     => array('label' => 'Mysql地址', 'other' => array('required' => true, 'rangelength' => '[2, 50]', 'value' => '127.0.0.1')),
        'mysqlPort'     => array('label' => 'Mysql端口', 'other' => array('required' => true, 'number' => true, 'value' => 3306)),
        'mysqlName'     => array('label' => 'Mysql库名', 'other' => array('required' => true, 'rangelength' => '[2, 50]', 'value' => 'bleach_games')),
        'mysqlUser'     => array('label' => 'Mysql用户名', 'other' => array('required' => true, 'rangelength' => '[2, 50]', 'value' => 'admin')),
        'mysqlPass'     => array('label' => 'Mysql密码', 'other' => array('required' => true, 'rangelength' => '[2, 50]')),
        'status'        => array('label' => '状态', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true, 'number' => true)),
        'recharge_status' => array('label' => '充值', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true, 'number' => true)),
    );

    // 数据验证
    protected $_validate = array(
        array('id', 'require', '标示ID不能为空', 1),
        array('id', 'number', '标示ID需要为一个数字', 1),
        array('projectId', 'require', '项目ID不能为空', 1),
        array('projectId', 'number', '项目ID必须为一个数字', 1),
        array('en_name', '/\S{2,12}/', '英文名需要2到20位字符', 1),
        array('cn_name', '/\S{2,12}/', '中文名需要2到20位字符', 1),
        array('loginSecret', '/\S{10}/', '登录密钥需要10位字符', 1),
        array('paymentSecret', '/\S{10}/', '充值密钥需要10位字符', 1),
        array('apiUrl', 'url', '接口地址格式错误', 1),
        array('mysqlHost', 'require', 'Mysql地址不能为空', 1),
        array('mysqlPort', 'require', 'Mysql端口不能为空', 1),
        array('mysqlPort', 'number', 'Mysql端口需要为数字', 1),
        array('mysqlName', 'require', 'Mysql库名不能为空', 1),
        array('mysqlUser', 'require', 'Mysql用户名不能为空', 1),
        array('mysqlPass', 'require', 'Mysql密码不能为空', 1),
        array('status', 'number', '状态必须为一个数字', 1),
        array('recharge_status', 'number', '充值状态必须为一个数字', 1),
    );

    // 详情信息
    public $attribute = array(
        'id'        => '标识ID',
        'projectId' => '项目ID',
        'en_name'   => '英文名',
        'cn_name'   => '中文名',
        'loginSecret'   => '登录密钥',
        'paymentSecret' => '充值密钥',
        'apiUrl'     => '接口地址',
        'status'     => '状态',
        'createTime' => '创建时间',
        'createId'   => '创建用户',
        'updateTime' => '修改时间',
        'updateId'   => '修改者ID',
        'unique'     => '唯一ID',
        'mysqlHost'  => 'Mysql地址',
        'mysqlPort'  => 'Mysql端口',
        'mysqlName'  => 'Mysql库名',
        'mysqlUser'  => 'Mysql用户名',
        'mysqlPass'  => 'Mysql密码',
        'recharge_status' => '充值状态',
    );
}