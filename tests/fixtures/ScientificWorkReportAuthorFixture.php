<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class ScientificWorkReportAuthorFixture extends BaseActiveFixture
{
    public $modelClass = 'models\ScientificWorkReportAuthor';
    public $dataFile = 'tests/_data/scientific_work_report_authors.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\ScientificWorkReportFixture',
    ];
}
