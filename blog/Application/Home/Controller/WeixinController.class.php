<?php
/**
 * file: IndexController.class.php
 * desc: 项目主要目录(首页控制器)
 * user: liujx
 * date: 2015-11-15
 */

// 命名空间
namespace Home\Controller;
use Think\Controller;
use Home\Common;

/**
 * Class IndexController
 * @package Home\Controller
 * desc: 微信首页控制器
 */
class WeixinController extends Controller
{
    // 首页显示(图文信息的回复)
    public function index()
    {
        $wechatObj = new Common\Weixin();
        $wechatObj->responseMsg();
    }

    // 七夕主题的
    public function qixi()
    {
        $this->display('qixi');
    }

    // mylove
    public function love()
    {
        $this->display('index');
    }

    // 贪吃蛇
    public function snake()
    {
        $this->display('snake');
    }
}