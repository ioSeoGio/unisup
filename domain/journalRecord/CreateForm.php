<?php

namespace domain\journalRecord;

use seog\base\ModelAdapter;
use validators\ValidatorInterface;

use models\Teacher;
use models\Discipline;
use models\ClassType;
use models\Journal;
use models\Group;

class CreateForm extends ModelAdapter implements ValidatorInterface
{
    public $topic;

    public $class_type;
    public $journal_id;
    public $teacher_id;
    public $group_id;

    public $lesson_at;

    public function commonRules()
    {
        return [
            [['topic', 'lesson_at'], 'string'],
            [['class_type', 'journal_id', 'teacher_id', 'group_id'], 'integer'],

            [['class_type'], 'exist', 'skipOnError' => true, 'targetClass' => ClassType::class, 'targetAttribute' => ['class_type' => 'id']],
            [['journal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Journal::class, 'targetAttribute' => ['journal_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    public function rules()
    {
        return array_merge($this->commonRules(), [
            [['topic', 'class_type', 'journal_id', 'teacher_id', 'group_id', 'lesson_at'], 'required'],
        ]);
    }
}
