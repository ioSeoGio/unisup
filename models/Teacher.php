<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class Teacher extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%teachers}}';
    }

    public function rules()
    {
        return [
            [['full_name', 'department_id'], 'required'],
            [['department_id', 'academic_degree_id', 'academic_title_id', 'teacher_post_id'], 'default', 'value' => null],
            [['department_id', 'academic_degree_id', 'academic_title_id', 'teacher_post_id'], 'integer'],
            [['work_experience'], 'number'],
            [['full_name'], 'string', 'max' => 255],
            [['academic_degree_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicDegree::class, 'targetAttribute' => ['academic_degree_id' => 'id']],
            [['academic_title_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicTitle::class, 'targetAttribute' => ['academic_title_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
            [['teacher_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherPost::class, 'targetAttribute' => ['teacher_post_id' => 'id']]
        ];
    }

    public function getJournalRecords()
    {
        return $this->hasMany(JournalRecord::class, ['teacher_id' => 'id']);
    }

    public function getSubgroups()
    {
        return $this->hasMany(Subgroup::class, ['discipline_id' => 'id']);
    }

    public function getTeacherJournals()
    {
        return $this->hasMany(TeacherJournal::class, ['teacher_id' => 'id']);
    }

    public function getTeacherPreferences()
    {
        return $this->hasMany(TeacherPreference::class, ['teacher_id' => 'id']);
    }

    public function getAcademicDegree()
    {
        return $this->hasOne(AcademicDegree::class, ['id' => 'academic_degree_id']);
    }

    public function getAcademicTitle()
    {
        return $this->hasOne(AcademicTitle::class, ['id' => 'academic_title_id']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    public function getTeacherPost()
    {
        return $this->hasOne(TeacherPost::class, ['id' => 'teacher_post_id']);
    }

    public function getEducationalWorkReports()
    {
        return $this->hasMany(EducationalWorkReport::class, ['id' => 'work_report_id'])
            ->viaTable(ScientificWorkReportAuthor::tableName(), ['teacher_id' => 'id']);
    }

    public function getScientificWorkReports()
    {
        return $this->hasMany(ScientificWorkReport::class, ['id' => 'work_report_id'])
            ->viaTable(ScientificWorkReportAuthor::tableName(), ['teacher_id' => 'id']);
    }

    public function getMethodicalWorkReports()
    {
        return $this->hasMany(MethodicalWorkReport::class, ['id' => 'work_report_id'])
            ->viaTable(MethodicalWorkReportAuthor::tableName(), ['teacher_id' => 'id']);
    }
}
