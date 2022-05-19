<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class EducationalWorkReportFixture extends ActiveFixture
{
    public $modelClass = 'models\EducationalWorkReport';
    public $dataFile = '@tests/fixtures/data/educational-work-reports.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\EducationalWorkReportAuthorFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}