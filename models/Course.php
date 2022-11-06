<?php declare(strict_types=1);

namespace models;

use domain\semester\factory\SemesterFactory;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Course extends ActiveRecordAdapter
{
    public static function tableName(): string
    {
        return '{{%courses}}';
    }

    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        SemesterFactory::createFromCourse($this);
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function getGroups(): ActiveQueryInterface
    {
        return $this->hasMany(Group::class, ['course_id' => 'id']);
    }

    public function getStudents(): ActiveQueryInterface
    {
        return $this->hasMany(Student::class, ['course_id' => 'id']);
    }

    public function getTeacherPreferences(): ActiveQueryInterface
    {
        return $this->hasMany(TeacherPreference::class, ['course_id' => 'id']);
    }
}
