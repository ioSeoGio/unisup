<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['specialization_id' => 'id']);
    }
}
