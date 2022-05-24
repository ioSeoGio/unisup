<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class TeacherJournal extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%teacher_journals}}';
    }

    public function rules()
    {
        return [
            [['name', 'teacher_id'], 'required'],
            [['teacher_id', 'discipline_id'], 'default', 'value' => null],
            [['teacher_id', 'discipline_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['discipline_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    public function getJournalRecords(): ActiveQueryInterface
    {
        return $this->hasMany(JournalRecord::class, ['journal_id' => 'id']);
    }

    public function getDiscipline(): ActiveQueryInterface
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
