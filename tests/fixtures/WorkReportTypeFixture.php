<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class WorkReportTypeFixture extends BaseActiveFixture
{
    public $modelClass = 'models\WorkReportType';
    public $dataFile = 'tests/_data/work_report_types.php';

    public $depends = [
    ];
}
