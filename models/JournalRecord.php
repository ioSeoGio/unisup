<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class JournalRecord extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%journal_records}}';
    }

    public function rules()
    {
        return [
            [['topic', 'class_type', 'journal_id', 'teacher_id', 'group_id', 'lesson_at'], 'required'],
            [['hours_amount'], 'number'],
            [['class_type', 'journal_id', 'teacher_id', 'group_id'], 'default', 'value' => null],
            [['class_type', 'journal_id', 'teacher_id', 'group_id'], 'integer'],
            [['lesson_at'], 'safe'],
            [['topic'], 'string', 'max' => 255],
            [['class_type'], 'exist', 'skipOnError' => true, 'targetClass' => ClassType::class, 'targetAttribute' => ['class_type' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::class, 'targetAttribute' => ['journal_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    public function getClassType(): ActiveQueryInterface
    {
        return $this->hasOne(ClassType::class, ['id' => 'class_type']);
    }

    public function getGroup(): ActiveQueryInterface
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    public function getJournal(): ActiveQueryInterface
    {
        return $this->hasOne(Journal::class, ['id' => 'journal_id']);
    }

    public function getTeacher(): ActiveQueryInterface
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }
}
