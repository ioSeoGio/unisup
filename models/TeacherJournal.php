<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalRecords()
    {
        return $this->hasMany(JournalRecord::class, ['journal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
