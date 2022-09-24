<?php declare(strict_types=1);

namespace models;

use models\base\WorkReport;
use yii\db\ActiveQueryInterface;

class EducationalWorkReport extends WorkReport
{
    public static function tableName()
    {
        return '{{%educational_work_reports}}';
    }

    public function rules()
    {
        return [
            [['description', 'level', 'type_id'], 'required'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkReportType::class, 'targetAttribute' => ['type_id' => 'id']],

        ];
    }

    public function getTeachers(): ActiveQueryInterface
    {
        return $this->hasMany(Teacher::class, ['id' => 'teacher_id'])
            ->viaTable(EducationalWorkReportAuthor::tableName(), ['work_report_id' => 'id']);
    }
    
    public function getType(): ActiveQueryInterface
    {
        return $this->hasOne(WorkReportType::class, ['id' => 'type_id']);
    }
}
