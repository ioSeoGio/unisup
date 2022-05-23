<?php

namespace domain\methodicalWork;

use seog\base\ModelAdapter;
use validators\ValidatorInterface;

class UpdateForm extends CreateForm implements ValidatorInterface
{
    public $id;

    public function rules()
    {
        return array_merge($this->commonRules(), [
            [['id'], 'required'],
        ]);
    }
}
