<?php

namespace app\modules\admin;

use app\rbac\Rbac;
use Yii;
use seog\base\Module as BaseModule;
use yii\web\NotFoundHttpException;

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
