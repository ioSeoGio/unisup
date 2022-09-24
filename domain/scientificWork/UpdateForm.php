<?php declare(strict_types=1);

namespace domain\scientificWork;

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
