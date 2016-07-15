<?php
return [
	// 路由规则
    'URL_ROUTE_RULES' => [],
    'VAR_PAGE'        => 'page',                    // 分页信息提交参数
    // 前端资源配置
    'TMPL_PARSE_STRING' => [
        '__PUBLIC__'  => '/Public',                 // 更改默认的/Public 替换规则
        '__CSS__'     => '/Public/assets/css',      // css文件地址
        '__JS__'      => '/Public/assets/js',       // 增加新的JS类库路径替换规则
        '__UPLOAD__'  => '/Public/Uploads',         // 增加新的上传路径替换规则
    ],
    // 开启布局
    'LAYOUT_ON'         => true,
    'LAYOUT_NAME'       => 'Layout/main',
    'TMPL_LAYOUT_ITEM'  => '{__CONTENT__}',
    'DATA_CACHE_TYPE'   => 'Kvdbsae',
    'DATA_CACHE_PREFIX' => 'wx_',
    'DATA_CACHE_TIME'   => 0,
    // 数据库设置
    'DB_TYPE'               => 'mysql',             // 数据库类型
    'DB_HOST'               => '127.0.0.1',         // 服务器地址
    'DB_PORT'               => 3306,                // 服务器端口
    'DB_NAME'               => 'my_project',        // 数据库名
    'DB_USER'               => 'root',              // 用户名
    'DB_PWD'                => 'gongyan',           // 密码
    'DB_PREFIX'             => 'my_',               // 数据库表前缀
];