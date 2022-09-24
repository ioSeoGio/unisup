<?php declare(strict_types=1);

namespace models;

use models\base\WorkReport;
use yii\db\ActiveQueryInterface;

class MethodicalWorkReportAuthor extends WorkReport
{
    public static function tableName()
    {
        return '{{%methodical_work_report_authors}}';
    }

    public function rules()
    {
        return [
            [['work_report_id', 'teacher_id'], 'required'],
            [['work_report_id', 'teacher_id'], 'default', 'value' => null],
            [['work_report_id', 'teacher_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['work_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => MethodicalWorkReport::class, 'targetAttribute' => ['work_report_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    public function getMethodicalWorkReport(): ActiveQueryInterface
    {
        return $this->hasOne(MethodicalWorkReport::class, ['id' => 'work_report_id']);
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
