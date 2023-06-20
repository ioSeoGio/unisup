<?php declare(strict_types=1);

namespace domain\teacherTimeManagement\service;

use models\TeacherRate;
use models\TeacherTimeManagement;
use yii\db\Expression;

abstract class AbstractTimeManagementCalculator
{
    public const ALLOWED_INACCURACY_IN_HOURS = 10;

    abstract public function calculate(): void;

    protected function initCalculatorData(): void
    {
        TeacherTimeManagement::updateAll(['hours' => 0]);
        TeacherRate::updateAll(['hours_left' => new Expression('hours')]);
    }
}
