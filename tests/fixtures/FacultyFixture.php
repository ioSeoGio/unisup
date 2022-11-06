<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class FacultyFixture extends BaseActiveFixture
{
    public $modelClass = 'models\Faculty';
    public $dataFile = 'tests/_data/faculties.php';

    public $depends = [
    ];
}
