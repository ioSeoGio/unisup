<?php

namespace models;

use seog\db\ActiveRecordAdapter;

class EducationalWorkReportAuthor extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%educational_work_report_authors}}';
    }

    public function rules()
    {
        return [
            [['educational_work_report_id', 'teacher_id'], 'required'],
            [['educational_work_report_id', 'teacher_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['educational_work_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => EducationalWorkReport::class, 'targetAttribute' => ['educational_work_report_id' => 'id']],
        ];
    }

    public function getEducationalWorkReport()
    {
        return $this->hasOne(EducationalWorkReport::class, ['id' => 'educational_work_report_id']);
    }

    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
