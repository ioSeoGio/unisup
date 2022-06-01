<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class JournalFixture extends ActiveFixture
{
    public $modelClass = 'models\Journal';
    public $dataFile = 'tests/_data/journals.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\DisciplineFixture',
    ];
}