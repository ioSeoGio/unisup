<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class TeacherTimeManagement extends ActiveRecordAdapter
{
    public static function tableName(): string
    {
        return '{{%teacher_time_managements}}';
    }

    public function rules(): array
    {
        return [
            [['discipline_id', 'semester_id', 'teacher_id'], 'default', 'value' => null],
            [['discipline_id', 'semester_id', 'teacher_id'], 'integer'],
            [['hours'], 'double', 'min' => 0],
            [['hours'], 'default', 'value' => 0],
            [['discipline_id', 'semester_id', 'teacher_id', 'hours'], 'required'],

            ['teacher_id', 'unique', 'targetAttribute' => ['discipline_id', 'semester_id', 'teacher_id']],

            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::class, 'targetAttribute' => ['semester_id' => 'id']],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['discipline_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    public static function updateWithGivenPreferenceAndHours(
        TeacherPreference $teacherPreference,
        float $hours,
    ): void {
        $record = self::findOne([
            'discipline_id' => $teacherPreference->discipline_id,
            'semester_id' => $teacherPreference->semester_id,
            'teacher_id' => $teacherPreference->teacher_id,
        ]);
        $record->hours = $hours;
        $record->save();
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

    public function getHours(): float
    {
        return $this->hours;
    }

    public function setHours(float $hours): void
    {
        $this->hours = $hours;
    }
}
