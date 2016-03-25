<?php
return array(
    'APP_DEBUG'	=> true,                       // 调试模式
    'DB_TYPE'	=> 'mysql', 					// 数据库类型
    'DB_HOST'	=> 'localhost', 				// 数据库朋务器地址
    'DB_NAME'	=> 'gametrees_bmmigrant', 		// 数据库名称
    'DB_USER'	=> 'root', 					    // 数据库用户名
    'DB_PWD'	=> 'gongyan', 					// 数据库密码
    'DB_PORT'	=> '3306', 						// 数据库端口
    'DB_PREFIX'	=> 'gt_project_', 				// 数据表前缀

    'TMPL_PARSE_STRING'	=> array(
        '__PUBLIC__' 	=> '/Public',
    ),

    'TMPL_CACHE_ON'		=>	false,      // 默认开启模板缓存
    'OFFICIAL'			=> 'http://www.gametrees.com',
    'COIN_RATE'			=> 30,
    'TOKEN_ON'          => false,       // 表单令牌验证
);
?>