<?php declare(strict_types=1);

namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class CourseFixture extends ActiveFixture
{
    public $modelClass = 'models\Course';
    public $dataFile = 'tests/_data/courses.php';

    public $depends = [
    ];
}
