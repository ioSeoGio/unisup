<?php

namespace app\modules\documentBuilder;

use app\rbac\Rbac;
use seog\base\Module as BaseModule;
use yii\web\NotFoundHttpException;
use Yii;

class Module extends BaseModule
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

}
