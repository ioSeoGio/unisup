<?php

$common = require __DIR__ . '/common.php';
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = array_merge_recursive($common, [
    'id' => 'app',
    'name' => 'UniSup',
    'basePath' => dirname(__DIR__),

    'bootstrap' => [
        'log', 
    ],
    'aliases' => [
    ],
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
        ],
        'request' => [
            'class' => 'seog\web\RequestAdapterInterface',
            'cookieValidationKey' => '6MN-T0hVLs5fEOJuJv37RI6f4YCQJKuc',
            'parsers' => [
                'application/json' => 'seog\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => 'json',
            'formatters' => [
                'json' => [
                    'class' => 'seog\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
            'on beforeSend' => function ($event) {
                $response = $event->sender;

                $rbacHandler = Yii::$app->rbacHandler;
                $messageHandler = Yii::$app->messageHandler;
                
                if ($response->data !== null && $response->isSuccessful) {
                    $response->data = [
                        'data' => $response->data,
                        'rbac' => $rbacHandler->dump(),
                        'messages' => $messageHandler->dump(),
                    ];
                }
            },
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'models\UserIdentity',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'errorHandler' => [
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // ['class' => 'yii\rest\UrlRule'],
                
                '<module:admin>/<controller>/read/<id:[\d+]>' => '<module>/<controller>/read',
                '<module:admin>' => '<module>/site/index',
                
                '<action:[\w-]+>' => 'site/<action>',
                '<controller:[\w-]+>' => '<controller>/index',
                '' => 'site/index',
            ],
        ],
    ],
    'params' => $params,
]);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1', 'localhost', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1', 'localhost', '*'],
    ];
}

return $config;
