<?php

$common = require __DIR__ . '/common.php';
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

$config = array_merge_recursive($common, [
    'id' => 'veloportal-test-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@tests' => '@app/tests',
    ],
    'components' => [
        'db' => $db,
    ],
]);

return $config;
