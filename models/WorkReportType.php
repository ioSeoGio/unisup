<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

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

    public function getEducationalWorkReports(): ActiveQueryInterface
    {
        return $this->hasMany(EducationalWorkReport::class, ['type_id' => 'id']);
    }
}
