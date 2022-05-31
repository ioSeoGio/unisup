<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

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

    public function getGroups(): ActiveQueryInterface
    {
        return $this->hasMany(Group::class, ['course_id' => 'id']);
    }

    public function getStudents(): ActiveQueryInterface
    {
        return $this->hasMany(Student::class, ['course_id' => 'id']);
    }

    public function getTeacherPreferences(): ActiveQueryInterface
    {
        return $this->hasMany(TeacherPreference::class, ['course_id' => 'id']);
    }
}
