<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class JournalRecordFixture extends BaseActiveFixture
{
    public $modelClass = 'models\JournalRecord';
    public $dataFile = 'tests/_data/journal_records.php';

    public $depends = [
        'tests\fixtures\ClassTypeFixture',
        'tests\fixtures\JournalFixture',
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\GroupFixture',
    ];
}
