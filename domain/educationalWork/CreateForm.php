<?php declare(strict_types=1);

namespace domain\educationalWork;

use seog\base\ModelAdapter;
use validators\ValidatorInterface;

use models\Teacher;
use models\WorkReportType;
use domain\workReport\WorkReportLevel;

class CreateForm extends ModelAdapter implements ValidatorInterface
{
    public $description;
    public $level;
    public $type_id;
    public $teachers;

    public function commonRules()
    {
        return [
            [['description', 'level'], 'string'],
            [['type_id'], 'integer'],
            [['teachers'], 'each', 'rule' => ['integer']],
            [['teachers'], 'each', 'rule' => ['exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teachers' => 'id']]],

            [['level'], 'in', 'range' => [WorkReportLevel::BREST, WorkReportLevel::BELARUS, WorkReportLevel::FOREIGN]],
            
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkReportType::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    public function rules()
    {
        return array_merge($this->commonRules(), [
            [['description', 'level', 'teachers', 'type_id'], 'required'],
        ]);
    }
}
