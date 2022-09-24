<?php declare(strict_types=1);

namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class MethodicalWorkReportAuthorFixture extends ActiveFixture
{
    public $modelClass = 'models\MethodicalWorkReportAuthor';
    public $dataFile = 'tests/_data/methodical_work_report_authors.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\MethodicalWorkReportFixture',
    ];
}