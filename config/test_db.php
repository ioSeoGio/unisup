<?php

$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'pgsql:host=db;dbname=veloportal_test_db';

return $db;
