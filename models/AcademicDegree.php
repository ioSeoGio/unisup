<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class AcademicDegree extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%academic_degrees}}';
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
        return $this->hasMany(Teacher::class, ['academic_degree_id' => 'id']);
    }
}
