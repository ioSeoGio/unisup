<?php declare(strict_types=1);

namespace models;

use models\base\WorkReport;
use yii\db\ActiveQueryInterface;

class MethodicalWorkReport extends WorkReport
{
    public static function tableName()
    {
        return '{{%methodical_work_reports}}';
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

    public function getMethodicalWorkReportAuthors(): ActiveQueryInterface
    {
        return $this->hasMany(MethodicalWorkReportAuthor::class, ['work_report_id' => 'id']);
    }

    public function getType(): ActiveQueryInterface
    {
        return $this->hasOne(WorkReportType::class, ['id' => 'type_id']);
    }


    public function getTeachers(): ActiveQueryInterface
    {
        return $this->hasMany(Teacher::class, ['id' => 'teacher_id'])
            ->viaTable(MethodicalWorkReportAuthor::tableName(), ['work_report_id' => 'id']);
    }
}
