<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class ScientificWorkReportFixture extends ActiveFixture
{
    public $modelClass = 'models\ScientificWorkReport';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}