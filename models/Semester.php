<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Semester extends ActiveRecordAdapter
{
    public const FIRST_SEMESTER = 'I';
    public const SECOND_SEMESTER = 'II';

    public const SEMESTERS = [self::FIRST_SEMESTER, self::SECOND_SEMESTER];

    public static function tableName(): string
    {
        return '{{%semesters}}';
    }

    public function rules(): array
    {
        return [
            [['name', 'course_name'], 'required'],
            [['name'], 'in', 'range' => self::SEMESTERS],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function getCourse(): ActiveQueryInterface
    {
        return $this->hasOne(Course::class, ['name' => 'course_name']);
    }
}
