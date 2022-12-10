<?php declare(strict_types=1);

namespace seog\db;

use domain\common\ArrayableInterface;
use exceptions\ValidationException;
use helpers\Formatter;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQueryInterface;
use yii\db\BaseActiveRecord as BaseActiveRecordAlias;
use yii\web\NotFoundHttpException;

abstract class ActiveRecordAdapter extends BaseActiveRecord implements ArrayableInterface
{
    public function saveAndThrowOnError(): void
    {
        $result = $this->save();
        if (false === $result) {
            throw new ValidationException($this->getErrors());
        }
    }

    public function asArray(): array
    {
        $relations = [];
        foreach ($this->getRelationList() as $relation) {
            $relations[$relation] = $this->$relation;
        }
        return $this->attributes;
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecordAlias::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() {
                    return Formatter::currentDateTime();
                }
            ],
        ];
    }

    public function extraFields(): array
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
    public function getRelationList(): array
    {
        $reflection = new \ReflectionClass($this);
        $relations = [];
        foreach ($reflection->getMethods() as $method) {
            if ($method->getReturnType()?->getName() === ActiveQueryInterface::class) {
                $relations[] = lcfirst(str_replace('get', '', $method->name));
            }
        }

        return $relations;
    }

    public static function getOne(array $criteria): static
    {
        $record = self::findOne($criteria);
        if (null === $record) {
            throw new NotFoundHttpException();
        }

        return $record;
    }
}
