<?php

namespace seog\db;

use domain\common\ArrayableInterface;
use helpers\Formatter;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQueryInterface;

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

    public function extraFields()
    {
        return array_merge($this->getRelationList(), [
        ]);
    }

    /**
     * List of AR relations
     * Used to add relations to extraFields by default
     * WARNING: You should define return type of relation function \yii\db\ActiveQueryInterface like this:
     * ```php
     * public function getTeacher(): \yii\db\ActiveQueryInterface
     * ...
     * ``` 
     */
    protected function getRelationList()
    {
        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getMethods() as $method) {
            if ($method->getReturnType()?->getName() !== ActiveQueryInterface::class) {
                continue;
            }
            $relations[] = lcfirst(str_replace('get', '', $method->name));
        }
        return $relations;
    }
}
