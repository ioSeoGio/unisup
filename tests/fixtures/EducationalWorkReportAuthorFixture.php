<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class EducationalWorkReportAuthorFixture extends ActiveFixture
{
    public $modelClass = 'models\EducationalWorkReportAuthor';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\EducationalWorkReportFixture',
    ];
}