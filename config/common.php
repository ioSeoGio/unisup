<?php

use dispatchers\SimpleEventDispatcher;

$languages = require __DIR__ . '/languages.php';

return array_merge(
	$languages, 
[
    'bootstrap' => [
        'app\bootstrap\Bootstrap',
    ],
    'container' => [
    	'singletons' => [
    		'seog\web\RequestAdapterInterface' => 'seog\web\RequestAdapter',
    		'components\RbacHandlerInterface' => 'components\RbacHandler',
    		'components\MessageHandlerInterface' => 'components\MessageHandler',
    		'dispatchers\EventDispatcherInterface' => function () {
				return new SimpleEventDispatcher([
					'domain\login\LoginSuccessEvent' => ['domain\login\LoginSuccessEventListener'],
					'domain\login\LoginFailedEvent' => ['domain\login\LoginFailedEventListener'],
				]); 
    		}
    	],
    ],
	'aliases' => [
		'@web' => '@app/web',
		'@admin' => '@app/modules/admin',        
        '@message' => '@app/message',
	],
	'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
	],
	'components' => [
        'request' => [
        	'class' => 'seog\web\RequestAdapterInterface',
            'cookieValidationKey' => '6MN-T0hVLs5fEOJuJv37RI6f4YCQJKuc',
            'parsers' => [
               'application/json' => 'seog\web\JsonParser',
            ],
        ],
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
]);
