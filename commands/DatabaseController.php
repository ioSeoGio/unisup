<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class DatabaseController extends Controller
{
    public function actionSafeCreate($databaseName): int
    {
        $databaseExists = (bool) Yii::$app->db->createCommand("
            SELECT datname FROM pg_catalog.pg_database WHERE lower(datname) = lower('$databaseName');
        ")->queryOne();

        if (!$databaseExists) {
            Yii::$app->db->createCommand("CREATE DATABASE {$databaseName}")->execute();
        }

        return ExitCode::OK;
    }
}
