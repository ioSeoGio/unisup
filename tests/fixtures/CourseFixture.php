<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class CourseFixture extends BaseActiveFixture
{
    public $modelClass = 'models\Course';
    public $dataFile = 'tests/_data/courses.php';

    public $depends = [
    ];
}
