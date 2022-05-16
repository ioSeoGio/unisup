<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalRecords()
    {
        return $this->hasMany(JournalRecord::class, ['class_type' => 'id']);
    }
}
