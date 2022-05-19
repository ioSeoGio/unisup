<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class WorkReportTypeFixture extends ActiveFixture
{
    public $modelClass = 'models\WorkReportType';
    public $dataFile = '@tests/fixtures/data/work-report-types.php';

    public $depends = [
    ];
}