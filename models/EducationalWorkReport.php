<?php

namespace models;

use models\base\WorkReport;

class EducationalWorkReport extends WorkReport
{
    public static function tableName()
    {
        return '{{%educational_work_reports}}';
    }

    public function rules()
    {
        return [
            [['description', 'level', 'teacher_id', 'type_id'], 'required'],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkReportType::class, 'targetAttribute' => ['type_id' => 'id']],

        ];
    }

    public function getTeachers()
    {
        return $this->hasMany(Teacher::class, ['id' => 'teacher_id'])
            ->viaTable(EducationalWorkReportAuthor::tableName(), ['educational_work_report_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(WorkReportType::class, ['id' => 'type_id']);
    }
}
