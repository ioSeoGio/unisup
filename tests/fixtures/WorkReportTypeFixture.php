<?php declare(strict_types=1);

namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class WorkReportTypeFixture extends ActiveFixture
{
    public $modelClass = 'models\WorkReportType';
    public $dataFile = 'tests/_data/work_report_types.php';

    public $depends = [
    ];
}