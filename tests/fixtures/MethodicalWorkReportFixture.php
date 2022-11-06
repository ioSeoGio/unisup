<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class MethodicalWorkReportFixture extends BaseActiveFixture
{
    public $modelClass = 'models\MethodicalWorkReport';
    public $dataFile = 'tests/_data/methodical_work_reports.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}
