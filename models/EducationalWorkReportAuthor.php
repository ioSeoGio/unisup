<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class EducationalWorkReportAuthor extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%educational_work_report_authors}}';
    }

    public function rules()
    {
        return [
            [['work_report_id', 'teacher_id'], 'required'],
            [['work_report_id', 'teacher_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['work_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => EducationalWorkReport::class, 'targetAttribute' => ['work_report_id' => 'id']],
        ];
    }

    public function getEducationalWorkReport(): ActiveQueryInterface
    {
        return $this->hasOne(EducationalWorkReport::class, ['id' => 'work_report_id']);
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
