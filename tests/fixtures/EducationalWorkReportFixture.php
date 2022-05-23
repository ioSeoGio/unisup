<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class EducationalWorkReportFixture extends ActiveFixture
{
    public $modelClass = 'models\EducationalWorkReport';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}