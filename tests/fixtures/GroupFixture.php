<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class GroupFixture extends BaseActiveFixture
{
    public $modelClass = 'models\Group';
    public $dataFile = 'tests/_data/groups.php';

    public $depends = [
        'tests\fixtures\SpecialtyFixture',
        'tests\fixtures\CourseFixture',
        'tests\fixtures\FacultyFixture',
    ];
}
