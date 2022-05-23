<?php
$params = require __DIR__ . '/params.php';

$web = require __DIR__ . '/web.php';
$db = require __DIR__ . '/test_db.php';

$web['id'] = 'test';
$web['components']['mailer'] = [
    'useFileTransport' => true,
];
$web['components']['db'] = $db;
$web['params'] = $params;
return $web;
