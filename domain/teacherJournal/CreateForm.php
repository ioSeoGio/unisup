<?php

namespace domain\teacherJournal;

use seog\base\ModelAdapter;
use validators\ValidatorInterface;

use models\Teacher;
use models\Discipline;

class CreateForm extends ModelAdapter implements ValidatorInterface
{
    public $name;
    public $teacher_id;
    public $discipline_id;

    public function commonRules()
    {
        return [
            [['name'], 'string'],
            [['teacher_id', 'discipline_id'], 'integer'],

            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['discipline_id' => 'id']],
        ];
    }

    public function rules()
    {
        return array_merge($this->commonRules(), [
            [['name', 'teacher_id', 'discipline_id'], 'required'],
        ]);
    }
}
