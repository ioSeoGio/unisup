<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class EducationalWorkReportAuthorFixture extends ActiveFixture
{
    public $modelClass = 'models\EducationalWorkReportAuthor';
    public $dataFile = '@tests/fixtures/data/educational-work-report-authors.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
    ];
}