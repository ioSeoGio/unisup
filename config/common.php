<?php

use components\MessageHandler;
use components\MessageHandlerInterface;
use components\RbacHandler;
use components\RbacHandlerInterface;
use dispatchers\EventDispatcherInterface;
use dispatchers\SimpleEventDispatcher;
use domain\login\LoginSuccessEvent;
use domain\login\LoginSuccessEventListener;
use domain\user\UserRepository;
use domain\teacher\TeacherRepository;
use seog\db\ActiveQueryAdapter;
use seog\db\QueryInterface;
use seog\web\RequestAdapter;
use seog\web\RequestAdapterInterface;

$languages = require __DIR__ . '/languages.php';

return array_merge(
    $languages,
    [
        'container' => [
            'singletons' => [
                RequestAdapterInterface::class => RequestAdapter::class,
                QueryInterface::class => ActiveQueryAdapter::class,

                RbacHandlerInterface::class => RbacHandler::class,
                MessageHandlerInterface::class => MessageHandler::class,

                EventDispatcherInterface::class => function () {
                    return new SimpleEventDispatcher([
                        LoginSuccessEvent::class => [LoginSuccessEventListener::class],
                    ]);
                },

                UserRepository::class => function () {
                    return new UserRepository(new \models\query\UserQuery);
                },
                TeacherRepository::class => function () {
                    return new TeacherRepository(new \models\query\TeacherQuery);
                },
            ],
        ],
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
