<?php

namespace yiiseog\db;

use domain\common\ArrayableInterface;
use yii\db\ActiveRecord as BaseActiveRecord;

abstract class ActiveRecordAdapter extends BaseActiveRecord implements ArrayableInterface
{
    public function asArray(): array
    {
        return $this->attributes;
    }
}
