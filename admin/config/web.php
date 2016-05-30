<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id'        => 'basic',
    'language'  => 'zh-CN',
    'basePath'  => dirname(__DIR__),
    'bootstrap' => ['log'],
    // 配置模块
    'modules' => [
        'admin' => [
            'class'  => 'app\modules\admin\Admin',
            'layout' => '@app/modules/admin/views/layouts/main',
        ],
    ],

    'components' => [
        // 路由配置
        'urlManager' => [
            'enablePrettyUrl'     => true,      // 路由路径化
            'enableStrictParsing' => false,     // 不要求网址严格匹配，则不需要输入rules
            'showScriptName'      => false,     // 隐藏脚本文件
            'suffix'              => '.html',   // 添加后缀名
            // 定义规则
            'rules' => [
                '' => 'site/index',
                '<modules:\w+>/<controller:\w+>/<action:\w+>' => '<modules>/<controller>/<action>',
                '<controller:\w+>/<id:\d+>'                   => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'      => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'               => '<controller>/<action>',
            ],
        ],

        // 资源注入
//        //use seastorage for assets使用sae发布资源
//        'assetManager' =>[
//            'class'=>'app\common\SaeAssetManager',
//            'assetDomain'=>'assets',
//            'converter' => [
//                'class' => 'yii\web\AssetConverter',
//            ],
//
//            'bundles' => [
//                // 去掉自己加载的Jquery
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,
//                    'js'         => [],
//                ],
//            ],
//        ],
        'assetManager' => [
            'bundles' => [
                // 去掉自己加载的Jquery
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js'         => [],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'my_blog',
        ],

        // 缓存数据
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['bootstrap'][]      = 'gii';
    $config['modules']['gii']   = 'yii\gii\Module';
}

return $config;
