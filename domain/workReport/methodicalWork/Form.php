<?php declare(strict_types=1);

namespace domain\workReport\methodicalWork;

use seog\base\ModelAdapter;
use validators\ValidatorInterface;
use models\Teacher;

class Form extends ModelAdapter implements ValidatorInterface
{
    public $documentHeaderString;
    public $teacherId;

    public function rules()
    {
        return [
            [['documentHeaderString', 'teacherId'], 'required'],
            [['documentHeaderString'], 'string'],
            [['teacherId'], 'integer'],
            [['teacherId'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacherId' => 'id']],
        ];
    }
}
