<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Group extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%groups}}';
    }

    public function rules()
    {
        return [
            [['name', 'course_id', 'faculty_id', 'specialization_id'], 'required'],
            [['course_id', 'number_of_students', 'faculty_id', 'specialization_id'], 'default', 'value' => null],
            [['course_id', 'number_of_students', 'faculty_id', 'specialization_id'], 'integer'],
            [['start_of_study', 'end_of_study'], 'safe'],
            [['name', 'form_of_study'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::class, 'targetAttribute' => ['faculty_id' => 'id']],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialty::class, 'targetAttribute' => ['specialization_id' => 'id']]
        ];
    }

    public function getCourse(): ActiveQueryInterface
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    public function getFaculty(): ActiveQueryInterface
    {
        return $this->hasOne(Faculty::class, ['id' => 'faculty_id']);
    }

    public function getSpecialization(): ActiveQueryInterface
    {
        return $this->hasOne(Specialty::class, ['id' => 'specialization_id']);
    }

    public function getJournalRecords(): ActiveQueryInterface
    {
        return $this->hasMany(JournalRecord::class, ['group_id' => 'id']);
    }

    public function getStudents(): ActiveQueryInterface
    {
        return $this->hasMany(Student::class, ['group_id' => 'id']);
    }

    public function getSubgroups(): ActiveQueryInterface
    {
        return $this->hasMany(Subgroup::class, ['discipline_id' => 'id']);
    }
}
