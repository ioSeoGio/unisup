<?php

namespace domain\educationalWork;

use seog\base\ModelAdapter;
use validators\ValidatorInterface;
use models\Teacher;

class EducationalWorkForm extends ModelAdapter implements ValidatorInterface
{
    public $documentHeaderString;
    public $teacherId;

    public function rules()
    {
        return [
            [['documentHeaderString', 'teacherId'], 'required'],
            [['documentHeaderString'], 'string'],
            [['teacherId'], 'integer'],
            [['teacherId'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacherId' => 'id']],
        ];
    }
}
