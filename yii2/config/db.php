<?php
/**
 * file: db.php
 * desc: 数据库配置文件
 * user: yii-liujx
 * date: 2016-2-5
 */
return [
    'class'       => 'yii\db\Connection',                      // 使用的类
    'dsn'         => 'mysql:host=localhost;dbname=my_blog',    // Mysql连接DSN
    'username'    => 'root',                                   // 用户名
    'password'    => 'gongyan',                                // 密码
    'charset'     => 'utf8',                                   // 字符集
    'tablePrefix' => 'my_blog_',                               // 表前缀
];
