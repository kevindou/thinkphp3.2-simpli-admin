<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        // 文件缓存
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        // 路由配置
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

        // 数据库配置
        'db' => [
            'class'       => 'yii\db\Connection',
            'dsb'         => 'mysql:host=127.0.0.1;dbname=my_yii2',
            'username'    => 'root',
            'password'    => 'gongyan',
            'charset'     => 'utf8',
            'tablePrefix' => 'my_',
        ],
    ],
];
