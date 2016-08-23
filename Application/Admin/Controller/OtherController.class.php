<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
class OtherController extends Controller
{

    // 显示进入首页
    public function index()
    {
        $this->display('Admin/other');
    }
}