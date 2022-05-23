<?php

namespace models;

use models\base\WorkReport;

class ScientificWorkReport extends WorkReport
{
    public static function tableName()
    {
        return '{{%scientific_work_reports}}';
    }

    public function rules()
    {
        return [
            [['description', 'level', 'type_id'], 'required'],
            [['description'], 'string'],
            [['type_id'], 'default', 'value' => null],
            [['type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['level'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkReportType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    public function getScientificWorkReportAuthors()
    {
        return $this->hasMany(ScientificWorkReportAuthor::class, ['work_report_id' => 'id']);
    }

    public function getType()
    {
        return $this->hasOne(WorkReportType::class, ['id' => 'type_id']);
    }

    public function getTeachers()
    {
        return $this->hasMany(Teacher::class, ['id' => 'teacher_id'])
            ->viaTable(ScientificWorkReportAuthor::tableName(), ['work_report_id' => 'id']);
    }
}
