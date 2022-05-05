<?php

namespace app\modules\admin;

use app\rbac\Rbac;
use Yii;
use yiiseog\base\Module as BaseModule;
use yii\web\NotFoundHttpException;

class Module extends BaseModule
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!Yii::$app->user->can(Rbac::MODERATOR)) {
            throw new NotFoundHttpException();
        }

        return true;
    }

}
