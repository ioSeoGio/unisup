<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class EducationalWorkReportAuthorFixture extends BaseActiveFixture
{
    public $modelClass = 'models\EducationalWorkReportAuthor';
    public $dataFile = 'tests/_data/educational_work_report_authors.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\EducationalWorkReportFixture',
    ];
}
