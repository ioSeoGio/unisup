<?php

$languages = require __DIR__ . '/languages.php';

return array_merge(
	$languages, 
[
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['user', 'moderator', 'admin'],
        ],
	],
]);
