<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class Course extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%courses}}';
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
        return $this->hasMany(Group::class, ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherPreferences()
    {
        return $this->hasMany(TeacherPreference::class, ['course_id' => 'id']);
    }
}
