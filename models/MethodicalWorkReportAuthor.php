<?php

namespace models;

use models\base\WorkReport;

class MethodicalWorkReportAuthor extends WorkReport
{
    public static function tableName()
    {
        return '{{%methodical_work_report_authors}}';
    }

    public function rules()
    {
        return [
            [['methodical_work_report_id', 'teacher_id'], 'required'],
            [['methodical_work_report_id', 'teacher_id'], 'default', 'value' => null],
            [['methodical_work_report_id', 'teacher_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['methodical_work_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => MethodicalWorkReport::class, 'targetAttribute' => ['methodical_work_report_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    public function getMethodicalWorkReport()
    {
        return $this->hasOne(MethodicalWorkReport::class, ['id' => 'methodical_work_report_id']);
    }

    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
