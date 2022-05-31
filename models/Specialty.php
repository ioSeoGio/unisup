<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Specialty extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%specialties}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function getGroups(): ActiveQueryInterface
    {
        return $this->hasMany(Group::class, ['specialization_id' => 'id']);
    }
}
