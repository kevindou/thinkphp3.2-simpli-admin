<?php
return array(
	// 路由规则
    'URL_ROUTE_RULES' => array(

    ),

    'VAR_PAGE'        => 'page',                    // 分页信息提交参数

    // 前端资源配置
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__'  => '/Public',                 // 更改默认的/Public 替换规则
        '__CSS__'     => '/Public/assets/css',      // css文件地址
        '__JS__'      => '/Public/assets/js',       // 增加新的JS类库路径替换规则
        '__UPLOAD__'  => '/Public/Uploads',         // 增加新的上传路径替换规则
    ),

    // 开启布局
    'LAYOUT_ON'         => true,
    'LAYOUT_NAME'       => 'Layout/index',
    'TMPL_LAYOUT_ITEM'  => '{__CONTENT__}',

    // 数据库设置
    'DB_TYPE'               =>  'mysql',        // 数据库类型
    'DB_HOST'               =>  'localhost',    // 服务器地址
    'DB_NAME'               =>  'my_blog',      // 数据库名
    'DB_USER'               =>  'root',         // 用户名
    'DB_PWD'                =>  'gongyan',      // 密码
    'DB_PORT'               =>  3306,           // 端口
    'DB_PREFIX'             =>  'my_blog_',  // 数据库表前缀
);