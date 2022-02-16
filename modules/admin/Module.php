<?php

namespace app\modules\admin;

use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use app\parent\base\Module as BaseModule;


class Module extends BaseModule
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        
        if (!Yii::$app->user->can('moderator')) {
            throw new NotFoundHttpException();
        }
    
        return true;
    }

}
