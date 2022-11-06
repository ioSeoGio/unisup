<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class TeacherFixture extends BaseActiveFixture
{
    public $modelClass = 'models\Teacher';
    public $dataFile = 'tests/_data/teachers.php';

    public $depends = [
    ];
}
