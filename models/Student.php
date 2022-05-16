<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class Student extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%students}}';
    }

    public function rules()
    {
        return [
            [['name', 'group_id', 'course_id'], 'required'],
            [['group_id', 'course_id'], 'default', 'value' => null],
            [['group_id', 'course_id'], 'integer'],
            [['name', 'form_of_study', 'form_of_payment'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']]
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
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }
}
