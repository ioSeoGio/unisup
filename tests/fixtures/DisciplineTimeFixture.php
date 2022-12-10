<?php declare(strict_types=1);

namespace tests\fixtures;

use domain\disciplineTime\factory\DisciplineTimeFactory;
use models\Discipline;
use models\DisciplineTime;
use seog\test\BaseActiveFixture;

class DisciplineTimeFixture extends BaseActiveFixture
{
    public $modelClass = DisciplineTime::class;

    public $depends = [
        SemesterFixture::class,
        DisciplineFixture::class,
    ];

    public function getData(): array
    {
        $models = [];
        foreach (Discipline::find()->each() as $discipline) {
            $models = array_merge(
                $models,
                DisciplineTimeFactory::getDataFromDiscipline($discipline, true)
            );
        }
        return $models;
    }
}
