<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class ScientificWorkReportAuthorFixture extends ActiveFixture
{
    public $modelClass = 'models\ScientificWorkReportAuthor';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\ScientificWorkReportFixture',
    ];
}