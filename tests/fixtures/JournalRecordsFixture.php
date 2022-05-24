<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class JournalRecordFixture extends ActiveFixture
{
    public $modelClass = 'models\JournalRecord';
    public $dataFile = 'tests/_data/journal_records.php';

    public $depends = [
        'tests\fixtures\ClassTypeFixture',
        'tests\fixtures\TeacherJournalFixture',
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\GroupFixture',
    ];
}