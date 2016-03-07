<?php
/**
 * file: IndexController.class.php
 * desc: 我的个人博客首页控制器
 * user: liujx
 * date: 2015-11-22
 */

// 引入命名空间
namespace Admin\Controller;
use Admin\Common\CommonController;
use Common\CHtml;

/**
 * Class IndexController
 * @package Home\Controller
 * desc: 首页控制器
 */

class OtherController extends CommonController
{
    // 初始化函数
    public function _initialize()
    {
        $this->searchMenu();
    }

    // 头部导航信息
    public function top()
    {
        $this->display('blankpage');
    }

    // 404错误信息
    public function error404()
    {
        $this->display();
    }

    // 500错误信息
    public function error500()
    {
        $this->display();
    }

    // 空白页
    public function blankpage()
    {
        $this->display();
    }
}