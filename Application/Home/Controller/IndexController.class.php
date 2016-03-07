<?php
/**
 * file: IndexController.class.php
 * desc: 我的个人博客首页控制器
 * user: liujx
 * date: 2015-11-22
 */

// 引入命名空间
namespace Home\Controller;
use Think\Controller;

/**
 * Class IndexController
 * @package Home\Controller
 * desc: 首页控制器
 */

class IndexController extends Controller
{
    public function index()
    {
        $this->display('index');
    }
}