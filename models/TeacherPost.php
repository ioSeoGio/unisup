<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class TeacherPost extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%teacher_posts}}';
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
    public function getTeachers()
    {
        return $this->hasMany(Teacher::class, ['teacher_post_id' => 'id']);
    }
}
