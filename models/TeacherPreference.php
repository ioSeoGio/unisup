<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class TeacherPreference extends ActiveRecordAdapter
{
    public static function tableName(): string
    {
        return '{{%teacher_preferences}}';
    }

    public function rules(): array
    {
        return [
            [['discipline_id', 'semester_id', 'teacher_id'], 'default', 'value' => null],
            [['discipline_id', 'semester_id', 'teacher_id'], 'integer'],
            [['importance_coefficient'], 'integer'],
            [['importance_coefficient'], 'default', 'value' => 0],
            [['discipline_id', 'semester_id', 'teacher_id'], 'required'],

            ['teacher_id', 'unique', 'targetAttribute' => ['discipline_id', 'semester_id', 'teacher_id']],

            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::class, 'targetAttribute' => ['semester_id' => 'id']],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['discipline_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    public function getCourse(): ActiveQueryInterface
    {
        return $this->hasOne(Course::class, ['name' => 'course_name'])
            ->viaTable(Semester::tableName(), ['id' => 'semester_id']);
    }

    public function getSemester(): ActiveQueryInterface
    {
        return $this->hasOne(Semester::class, ['id' => 'semester_id']);
    }

    public function getDiscipline(): ActiveQueryInterface
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
