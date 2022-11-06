<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class DisciplineFixture extends BaseActiveFixture
{
    public $modelClass = 'models\Discipline';
    public $dataFile = 'tests/_data/disciplines.php';

    public $depends = [
    ];
}
