<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class DisciplineTime extends ActiveRecordAdapter
{
    public static function tableName(): string
    {
        return '{{%discipline_time}}';
    }

    public function rules(): array
    {
        return [
            [['discipline_id', 'semester_id'], 'default', 'value' => null],
            [['discipline_id', 'semester_id'], 'integer'],
            [['hours'], 'double'],
            [['hours'], 'default', 'value' => 0],

            ['discipline_id', 'unique', 'targetAttribute' => ['discipline_id', 'semester_id']],

            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::class, 'targetAttribute' => ['semester_id' => 'id']],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['discipline_id' => 'id']],
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
}
