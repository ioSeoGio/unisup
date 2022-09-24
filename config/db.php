<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=unisup_db;dbname=unisup_db',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

    'commandMap' => [
        'pgsql' => 'seog\db\Command',
    ],
    'schemaMap' => [
        'pgsql'=> [
            'class'=>'yii\db\pgsql\Schema',
            'defaultSchema' => 'public',
        ]
    ],

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
