<?php declare(strict_types=1);

namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class ScientificWorkReportAuthorFixture extends ActiveFixture
{
    public $modelClass = 'models\ScientificWorkReportAuthor';
    public $dataFile = 'tests/_data/scientific_work_report_authors.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\ScientificWorkReportFixture',
    ];
}