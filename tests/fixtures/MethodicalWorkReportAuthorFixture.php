<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class MethodicalWorkReportAuthorFixture extends ActiveFixture
{
    public $modelClass = 'models\MethodicalWorkReportAuthor';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\MethodicalWorkReportFixture',
    ];
}