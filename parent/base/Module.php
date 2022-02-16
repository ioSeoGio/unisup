<?php

namespace app\parent\base;

use Yii;


class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        // inintialization of modules from config.php
        $configFile = require Yii::getAlias("@{$this->id}").'/config/config.php'; 
        Yii::configure($this, $configFile);     
    }
}
