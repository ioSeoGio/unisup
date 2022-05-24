<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class TeacherJournalFixture extends ActiveFixture
{
    public $modelClass = 'models\TeacherJournal';
    public $dataFile = 'tests/_data/teacher_journals.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\DisciplineFixture',
    ];
}