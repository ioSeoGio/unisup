<?php

namespace models;

use seog\db\ActiveRecordAdapter;

class ScientificWorkReportAuthor extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%scientific_work_report_authors}}';
    }

    public function rules()
    {
        return [
            [['scientific_work_report_id', 'teacher_id'], 'required'],
            [['scientific_work_report_id', 'teacher_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['scientific_work_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScientificWorkReport::class, 'targetAttribute' => ['scientific_work_report_id' => 'id']],
        ];
    }

    public function getScientificWorkReport()
    {
        return $this->hasOne(ScientificWorkReport::class, ['id' => 'scientific_work_report_id']);
    }

    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
