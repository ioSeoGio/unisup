<?php

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class ScientificWorkReportAuthor extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%scientific_work_report_authors}}';
    }

    public function rules()
    {
        return [
            [['work_report_id', 'teacher_id'], 'required'],
            [['work_report_id', 'teacher_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['work_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScientificWorkReport::class, 'targetAttribute' => ['work_report_id' => 'id']],
        ];
    }

    public function getScientificWorkReport(): ActiveQueryInterface
    {
        return $this->hasOne(ScientificWorkReport::class, ['id' => 'work_report_id']);
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
