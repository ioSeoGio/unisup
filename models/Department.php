<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class Department extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%departments}}';
    }

    public function rules()
    {
        return [
            [['name', 'faculty_id'], 'required'],
            [['faculty_id'], 'default', 'value' => null],
            [['faculty_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::class, 'targetAttribute' => ['faculty_id' => 'id']]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::class, ['id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::class, ['department_id' => 'id']);
    }
}
