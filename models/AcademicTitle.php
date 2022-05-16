<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class AcademicTitle extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%academic_titles}}';
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
        return $this->hasMany(Teacher::class, ['academic_title_id' => 'id']);
    }
}
