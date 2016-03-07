<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2015/12/31
 * Time: 18:03
 */
namespace Admin\Model;
use Admin\Common\CommonModel;

/**
 * Class UsersModel
 * @package Admin\Model
 * desc: 用户信息模型
 */
class AdminModel extends CommonModel
{
    // 显示详情信息
    public $attribute = array(
        'id'          => '标识ID',
        'username'    => '管理员账号',
        'password'    => '管理员密码',
        'email'       => '管理员Email',
        'status'      => '管理员状态',
        'last_time'   => '最后登录的时间',
        'last_ip'     => '最后登录的IP地址',
        'create_time' => '创建的时间',
    );

    // 显示列的属性
    public function showColModel()
    {
        return array(
            'id'          => array('width' => 60,  'editable' => false),
            'username'    => array('width' => 60, 'editrules'   => array('required' => true), 'editoptions' => array('required' => true, 'rangelength' =>'[2,12]')),
            'password'    => array('hidden' => true, 'editable' => true, 'edittype' => 'password',
                'editoptions' => array('required' => true, 'rangelength' =>'[6,12]'),
                'editrules'   => array('required' => true, 'edithidden' => true)
            ),
            'email'       => array('width' => 80,
                'editoptions' => array('reqired' => true, 'rangelength' => '[6, 25]'),
                'editrules' => array('required' => true, 'email' => true),
            ),
            'status'      => array('width' => 80, 'edittype' => 'select',
                'editoptions' => array('value'  => '0:停用;1:待审核;2:启用'),
                'editrules'   => array('number' => true, 'required' => true),
            ),
            'last_time'   => array('width' => 120, 'editable' => false),
            'last_ip'     => array('width' => 80,  'editable' => false),
            'create_time' => array('width' => 150, 'editable' => false),
        );
    }

    // 数据验证
    protected $_validate = array(
        array('username', 'require', '用户名称不能为空', 1),
        array('username', '/\w{2,20}/', '用户名称必须为2到20位字符', 1),
        array('username', '', '用户名称必须为2到20位字符', 1, 'unique', 1),
        array('status', 'number', '状态必须为数字', 1),
    );

    // 数据新增之前
    public function _before_insert(&$data,$options)
    {
        $data['update_time'] = $data['create_time'] = $data['last_time'] = time();
        return true;
    }

    public function _before_update(&$data, $options) 
    {
        if (empty($data['last_time'])) 
        {
            $data['update_time'] = time();
            $data['update_time'] = $_SESSION[$this->session]['id'];
        }
        return true;
    } 
}