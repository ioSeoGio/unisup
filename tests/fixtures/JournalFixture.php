<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class JournalFixture extends BaseActiveFixture
{
    public $modelClass = 'models\Journal';
    public $dataFile = 'tests/_data/journals.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\DisciplineFixture',
    ];
}
