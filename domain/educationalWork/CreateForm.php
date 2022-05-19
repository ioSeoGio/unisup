<?php

namespace domain\educationalWork;

use seog\base\ModelAdapter;
use validators\ValidatorInterface;

class CreateForm extends ModelAdapter implements ValidatorInterface
{
    public $description;
    public $level;
    public $teacher_id;
    public $type_id;

    public function rules()
    {
        return [
            [['description', 'level', 'teacher_id', 'type_id'], 'required'],
            [['description', 'level'], 'string'],
            [['teacher_id', 'type_id'], 'integer'],
        ];
    }
}
