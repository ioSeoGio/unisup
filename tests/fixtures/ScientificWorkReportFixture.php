<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class ScientificWorkReportFixture extends BaseActiveFixture
{
    public $modelClass = 'models\ScientificWorkReport';
    public $dataFile = 'tests/_data/scientific_work_reports.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}
