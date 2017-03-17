<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',
             // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'dd-MM-yyyy',
                \kartik\datecontrol\Module::FORMAT_TIME => 'HH:mm:ss',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'dd-MM-yyyy HH:mm:ss',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                \kartik\datecontrol\Module::FORMAT_TIME => 'php:U',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'php:U',
            ],
            // set your display timezone
            'displayTimezone' => 'Asia/Jakarta',
            // set your timezone for date saved to db
            'saveTimezone' => 'UTC',
            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                \kartik\datecontrol\Module::FORMAT_DATETIME => [], // setup if needed
                \kartik\datecontrol\Module::FORMAT_TIME => [], // setup if needed
            ],
            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ],
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ObW_q3aGVaUk52_lyJ_9Tek4-7zXtpwg',
        ],
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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            // rules
            'rules' => [
                // url rewrite rules
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'assetManager' => [
            /**
             * Uncomment this setting
             * to use CDN for jquery and bootstarp
             ********
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null, // do not publish the bundle, pake jquery cdn punya google
                    'js' => [
                      '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null, // do not publish the bundle, pake css punya bootswatch
                    'css' => [
                        '//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css',  //pake theme flatly copas dari webnya aja
                    ]
                ],
            ],
             ********/
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    */

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
