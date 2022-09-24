<?php declare(strict_types=1);

namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class MethodicalWorkReportFixture extends ActiveFixture
{
    public $modelClass = 'models\MethodicalWorkReport';
    public $dataFile = 'tests/_data/methodical_work_reports.php';

    public $depends = [
        'tests\fixtures\TeacherFixture',
        'tests\fixtures\WorkReportTypeFixture',
    ];
}