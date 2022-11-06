<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class EducationalWorkReportFixture extends BaseActiveFixture
{
    public $modelClass = 'models\EducationalWorkReport';
    public $dataFile = 'tests/_data/educational_work_reports.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}
