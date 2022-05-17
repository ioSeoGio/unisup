<?php

namespace app\models;

use Yii;

class ScientificWorkReport extends \yii\db\ActiveRecord
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
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScientificWorkReport::class, 'targetAttribute' => ['type_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkReportType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    public function getScientificWorkReportAuthors()
    {
        return $this->hasMany(ScientificWorkReportAuthor::class, ['scientific_work_report_id' => 'id']);
    }

    public function getWorkReportType()
    {
        return $this->hasOne(WorkReportType::class, ['id' => 'type_id']);
    }
}
