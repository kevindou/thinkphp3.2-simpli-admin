<?php
return [
    'language'   => 'zh-CN',
    'timeZone'   => 'Asia/Shanghai',
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

        // 资源管理修改
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ],
                // 去掉自己加载的Jquery
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js'         => [],
                ],
            ],
        ],

        // 多语言配置
        'i18n' => [
            'translations' => [
                '*' => [
                    'class'   => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],

            ],
        ],

        // 数据库配置
        'db' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=127.0.0.1;dbname=my_yii2',
            'username'    => 'root',
            'password'    => 'gongyan',
            'charset'     => 'utf8',
            'tablePrefix' => 'my_',
        ],
    ],
];
