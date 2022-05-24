<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class ClassType extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%class_types}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['time_coefficient'], 'number'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function getJournalRecords(): ActiveQueryInterface
    {
        return $this->hasMany(JournalRecord::class, ['class_type' => 'id']);
    }
}
