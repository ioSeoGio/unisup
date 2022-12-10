<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class TeacherRate extends ActiveRecordAdapter
{
    public static function tableName(): string
    {
        return '{{%teacher_rates}}';
    }

    public function rules(): array
    {
        return [
            [['teacher_id', 'hours', 'hours_left'], 'required'],
            [['hours'], 'default', 'value' => 0],
            [['hours', 'hours_left'], 'double', 'min' => 0],

            [['teacher_id'], 'integer'],
            [['teacher_id'], 'unique', 'targetAttribute' => ['teacher_id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
