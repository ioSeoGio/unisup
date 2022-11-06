<?php declare(strict_types=1);

namespace models;

use helpers\Formatter;
use seog\db\ActiveRecordAdapter;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQueryInterface;

class WorkReportType extends ActiveRecordAdapter
{
    public static function tableName(): string
    {
        return '{{%work_report_types}}';
    }

    public function rules(): array
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
