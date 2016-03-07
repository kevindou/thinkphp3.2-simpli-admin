<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 定义ThinkPHP框架路径

// 设置默认字符集
header('Content-Type:text/html;charset=UTF-8');
define('THINK_PATH', './ThinkPHP');

// 定义项目名称和路径
define('APP_NAME',  'Admin');
define('APP_PATH', './Admin');

// 加载框架入口文件
require(THINK_PATH."/ThinkPHP.php");

App::run();
?>