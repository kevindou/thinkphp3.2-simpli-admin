<?php
/**
 * Created by PhpStorm.
 * User: love
 * Date: 2016/1/3
 * Time: 21:57
 */

// 定义命名空间
namespace Common;
use Think\Controller;

class CommonController extends Controller
{
    // 定义信息
    public $status   = array('停用', '启用');
    public $strError = '服务器繁忙,请稍候再试...';

    // 公共信息(错误信息)
    public $error = array(
        'status' => 0,
        'msg'    => '提交数据参数错误！',
        'data'   => array(),
    );

    // 正确信息
    public $success = array(
        'status' => 1,
        'msg'    => '操作成功',
    );

    // 验证提交数据是否为空
    protected function emptyPost()
    {
        return isset($_POST) && ! empty($_POST);
    }
}