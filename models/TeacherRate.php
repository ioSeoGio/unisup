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
            [['hours',], 'default', 'value' => 0],
            [['teacher_id', 'hours',], 'required'],
            [['teacher_id'], 'integer'],
            [['hours'], 'double'],
            [['teacher_id'], 'unique', 'targetAttribute' => ['teacher_id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
