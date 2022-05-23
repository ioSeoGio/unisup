<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class MethodicalWorkReportFixture extends ActiveFixture
{
    public $modelClass = 'models\MethodicalWorkReport';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}