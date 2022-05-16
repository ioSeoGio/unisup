<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class WorkReportType extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%work_report_types}}';
    }

    public function rules()
    {
        return [
            [['serial_number', 'type', 'description'], 'required'],
            [['serial_number', 'foreign_points', 'belarus_points', 'brest_points'], 'integer'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducationalWorkReports()
    {
        return $this->hasMany(EducationalWorkReport::class, ['type_id' => 'id']);
    }
}
