<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class FacultyFixture extends ActiveFixture
{
    public $modelClass = 'models\Faculty';
    public $dataFile = 'tests/_data/faculties.php';

    public $depends = [
    ];
}
