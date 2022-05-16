<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class Discipline extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%disciplines}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'name_in_short'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubgroups()
    {
        return $this->hasMany(Subgroup::class, ['discipline_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherJournals()
    {
        return $this->hasMany(TeacherJournal::class, ['discipline_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherPreferences()
    {
        return $this->hasMany(TeacherPreference::class, ['discipline_id' => 'id']);
    }
}
