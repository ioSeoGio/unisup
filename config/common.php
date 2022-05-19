<?php

$languages = require __DIR__ . '/languages.php';
$di = require __DIR__ . '/di.php';

return array_merge(
    $languages,
    [
        'container' => $di,
        'aliases' => [
            '@web' => '@app/web',
            '@admin' => '@app/modules/admin',
            '@documentBuilder' => '@app/modules/documentBuilder',
        ],
        'modules' => [
            'admin' => [
                'class' => 'app\modules\admin\Module',
            ],
            'documentBuilder' => [
                'class' => 'app\modules\documentBuilder\Module',
            ],
        ],
        'components' => [
            'authManager' => [
                'class' => 'yii\rbac\DbManager',
                'defaultRoles' => ['user', 'moderator', 'admin'],
            ],
            'rbacHandler' => [
                'class' => 'components\RbacHandlerInterface',
            ],
            'messageHandler' => [
                'class' => 'components\MessageHandlerInterface',
            ],
        ],
    ]
);
