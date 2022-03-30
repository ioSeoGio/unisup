<?php

$common = require __DIR__ . '/common.php';
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

/**
 * Application configuration shared by all test types
 */
return array_merge_recursive($common, [
    'id' => 'test',

    'bootstrap' => [
    ],
    'basePath' => dirname(__DIR__),
    'aliases' => [
    ],
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'user' => [
            'identityClass' => 'models\UserIdentity',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'request' => [
        ],
    ],
    'params' => $params,
]);
