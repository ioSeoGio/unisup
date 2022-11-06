<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class ClassTypeFixture extends BaseActiveFixture
{
    public $modelClass = 'models\ClassType';
    public $dataFile = 'tests/_data/class_types.php';

    public $depends = [
    ];
}
