<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

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

    public function getTeachers(): ActiveQueryInterface
    {
        return $this->hasMany(Teacher::class, ['academic_degree_id' => 'id']);
    }
}
