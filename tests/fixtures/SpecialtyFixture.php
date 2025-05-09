<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class SpecialtyFixture extends BaseActiveFixture
{
    public $modelClass = 'models\Specialty';
    public $dataFile = 'tests/_data/specialities.php';

    public $depends = [
    ];
}
