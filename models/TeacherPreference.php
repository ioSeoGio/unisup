<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class TeacherPreference extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%teacher_preferences}}';
    }

    public function rules()
    {
        return [
            [['discipline_id', 'course_id', 'semester', 'teacher_id'], 'default', 'value' => null],
            [['discipline_id', 'course_id', 'semester', 'teacher_id'], 'integer'],
            [['teacher_id'], 'required'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['discipline_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
