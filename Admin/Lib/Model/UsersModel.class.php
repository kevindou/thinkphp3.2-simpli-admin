<?php
/**
 * file: AgentModel.class.php
 * desc: 平台控制器
 * user: liujx
 * date: 2015-11-30
 */
class UsersModel extends CommModel
{
    public $strLike = 'username,suid'; // LIKE查询字段
    // 表头字段
    public $arrShowTh = array(
        array('title' => '标识ID', 'name' => 'id', 'sort' => true, 'search' => array('type' => 'text')),
        array('title' => '游戏ID', 'name' => 'projectid'),
        array('title' => '平台ID', 'name' => 'agentid', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '用户名', 'name' => 'username', 'sort' => true),
        array('title' => '游戏UID', 'name' => 'suid', 'sort' => true),
        array('title' => '状态', 'name' => 'status', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '积分', 'name' => 'account', 'sort' => true),
        array('title' => '注册时间', 'name' => 'createTime', 'sort' => true),
    );

    // 添加数据
    public $arrAddTh = array(
        'username' => array('label' => '用户名', 'other' => array('required' => true, 'rangelength' => '[4, 20]')),
        'password' => array('label' => '密码', 'type' => 'password', 'other' => array('mpass' => true, 'required' => true, 'rangelength' => '[5, 25]')),
        'truepass' => array('label' => '确认密码',  'type' => 'password', 'other' => array('required' => true, 'rangelength' => '[5, 25]', 'equalTo' =>'input[mpass=1]')),
        'agentid'  => array('label' => '默认平台',  'type' => 'select', 'other' => array('required' => true)),
        'suid'     => array('label' => '玩家游戏ID', 'other' => array('rangelength' => '[2, 20]')),
        'status'   => array('label' => '玩家状态', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true)),
        'id'       => array('type' => 'hidden'),
    );

    // 导入数据表单信息
    public $arrImport = array(

        // 平台用户信息
        'agentid'   => array('label' => '导进平台ID', 'type' => 'select', 'other' => array('required' => true, 'number' => true, 'class' => 'm-agentId')),
        'serverid'  => array('label' => '导进服务器ID', 'type' => 'select', 'other' => array('required' => true, 'number' => true, 'class' => 'm-serverId')),
        'username'  => array('label' => '导进的用户账号', 'other' => array('required' => true, 'rangelength' => '[2, 30]')),
//        'lUserId'   => array('label' => '迁移修改lUserId', 'other' => array('rangelength' => '[2, 30]')),

        // 导进数据库信息
        'mongohost' => array('label' => '导进的Mongo地址', 'other' => array('required' => true, 'rangelength' => '[2, 20]')),
        'mongoport' => array('label' => '导进的Mongo端口', 'other' => array('required' => true, 'number' => true, 'value' => 27017)),
        'mongoname' => array('label' => '导进的Mongo库名', 'value' => 'bleach_', 'other' => array('required' => true)),

        // 数据来源信息
        'dbhost'  => array('label' => '来源Mongo地址', 'other' => array('required' => true, 'rangelength' => '[2,20]')),
        'dbport'  => array('label' => '来源Mongo端口', 'other' => array('required' => true, 'number' => true, 'value' => 27017)),
        'dbname'  => array('label' => '来源Mongo库名', 'value' => 'bleach_', 'other' => array('required' => true)),
        'sid'     => array('label' => '来源服务器ID',  'other' => array('required' => true, 'number' => true)),
    );

    // 修改迁移用户
    public $arrUpdateUser = array(
        'username'  => array('label' => '新的游戏ID', 'other' => array('required' => true, 'rangelength' => '[2, 30]')),
        'oldname'   => array('label' => '旧的游戏UID', 'other' => array('required' => true, 'rangelength' => '[2, 30]')),
        'agentid'   => array('label' => '平台ID', 'type' => 'select', 'other' => array('required' => true, 'number' => true, 'class' => 'm-agentId')),
        'serverid'  => array('label' => '服务器ID', 'type' => 'select', 'other' => array('required' => true, 'number' => true, 'class' => 'm-serverId')),
        'mongohost' => array('label' => 'Mongo地址', 'other' => array('required' => true, 'rangelength' => '[2, 20]')),
        'mongoport' => array('label' => 'Mongo端口', 'other' => array('required' => true, 'number' => true, 'value' => 27017)),
        'mongoname' => array('label' => 'Mongo库名', 'value' => 'bleach_', 'other' => array('required' => true)),
    );

    // 数据验证
    protected $_validate = array(
        array('username', '/\w{4,20}/', '用户名不能小于4位或者大于20位', 1),
        array('password', '/\w{5,20}/', '密码不能小于4位或者大于20位', 1, '', 1),
        array('truepass', '/\w{5,20}/', '确认密码不能小于4位或者大于20位', 1, '', 1),
        array('password', 'truepass', '确认密码和密码输入不一致', 1, 'confirm'),
        array('agentid', '/[1-9]{1}\d{0,}/', '需要选择平台', 1),
        array('username', '', '用户名已经存在', 1, 'unique', 1),
    );

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

    // 数据新增的之前操作
    protected function _before_insert(&$data,$options)
    {
        $intTime = time();
        if (empty($data['suid'])) $data['suid'] = 'gt_user_'.$intTime;
        $data['encrypt']    = md5($data['password']);
        $data['projectid']  = 1;
        $data['createTime'] = $data['updateTime'] = $intTime;
        $data['createId']   = $data['updateId']   = $_SESSION[$this->session]['id'];
        return true;
    }

    // 数据修改之前的处理
    protected function _before_update(&$data, $options)
    {
        // 判断密码是否修改
        if (empty($data['password']))
            unset($data['password']);
        else
            $data['encrypt'] = md5($data['password']);
        return parent::_before_update($data, $options); // TODO: Change the autogenerated stub
    }
}