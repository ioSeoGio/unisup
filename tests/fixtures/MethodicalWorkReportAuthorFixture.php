<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;

class MethodicalWorkReportAuthorFixture extends BaseActiveFixture
{
    public $modelClass = 'models\MethodicalWorkReportAuthor';
    public $dataFile = 'tests/_data/methodical_work_report_authors.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\MethodicalWorkReportFixture',
    ];
}
