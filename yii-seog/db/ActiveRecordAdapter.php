<?php

namespace seog\db;

use domain\common\ArrayableInterface;
use helpers\Formatter;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii\behaviors\TimestampBehavior;


abstract class ActiveRecordAdapter extends BaseActiveRecord implements ArrayableInterface
{
    public function asArray(): array
    {
        return $this->attributes;
    }

    public function behaviors()
    {
        return [
           'timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => function() {
                    return Formatter::currentDateTime();
                }
            ],
        ];
    }
}
