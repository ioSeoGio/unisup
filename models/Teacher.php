<?php declare(strict_types=1);

namespace models;

use domain\teacherPreference\factory\TeacherPreferenceFactory;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Teacher extends ActiveRecordAdapter
{
    public static function tableName(): string
    {
        return '{{%teachers}}';
    }

    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            TeacherPreferenceFactory::createManyFromTeacher($this);
        }
    }

    public function beforeDelete(): bool
    {
        foreach ($this->getTeacherPreferences()->each() as $preference) {
            $preference->delete();
        }

        return parent::beforeDelete();
    }

    public function rules(): array
    {
        return [
            [['full_name', 'department_id'], 'required'],
            [['department_id', 'academic_degree_id', 'academic_title_id', 'teacher_post_id'], 'default', 'value' => null],
            [['department_id', 'academic_degree_id', 'academic_title_id', 'teacher_post_id'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
            [['academic_degree_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicDegree::class, 'targetAttribute' => ['academic_degree_id' => 'id']],
            [['academic_title_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicTitle::class, 'targetAttribute' => ['academic_title_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
            [['teacher_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherPost::class, 'targetAttribute' => ['teacher_post_id' => 'id']]
        ];
    }

    public function getJournalRecords(): ActiveQueryInterface
    {
        return $this->hasMany(JournalRecord::class, ['teacher_id' => 'id']);
    }

    public function getSubgroups(): ActiveQueryInterface
    {
        return $this->hasMany(Subgroup::class, ['discipline_id' => 'id']);
    }

    public function getJournals(): ActiveQueryInterface
    {
        return $this->hasMany(Journal::class, ['teacher_id' => 'id']);
    }

    public function getTeacherPreferences(): ActiveQueryInterface
    {
        return $this->hasMany(TeacherPreference::class, ['teacher_id' => 'id']);
    }

    public function getAcademicDegree(): ActiveQueryInterface
    {
        return $this->hasOne(AcademicDegree::class, ['id' => 'academic_degree_id']);
    }

    public function getAcademicTitle(): ActiveQueryInterface
    {
        return $this->hasOne(AcademicTitle::class, ['id' => 'academic_title_id']);
    }

    public function getDepartment(): ActiveQueryInterface
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    public function getTeacherPost(): ActiveQueryInterface
    {
        return $this->hasOne(TeacherPost::class, ['id' => 'teacher_post_id']);
    }

    public function getEducationalWorkReports(): ActiveQueryInterface
    {
        return $this->hasMany(EducationalWorkReport::class, ['id' => 'work_report_id'])
            ->viaTable(ScientificWorkReportAuthor::tableName(), ['teacher_id' => 'id']);
    }

    public function getScientificWorkReports(): ActiveQueryInterface
    {
        return $this->hasMany(ScientificWorkReport::class, ['id' => 'work_report_id'])
            ->viaTable(ScientificWorkReportAuthor::tableName(), ['teacher_id' => 'id']);
    }

    public function getMethodicalWorkReports(): ActiveQueryInterface
    {
        return $this->hasMany(MethodicalWorkReport::class, ['id' => 'work_report_id'])
            ->viaTable(MethodicalWorkReportAuthor::tableName(), ['teacher_id' => 'id']);
    }
}
