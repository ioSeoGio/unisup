<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class TeacherFixture extends ActiveFixture
{
    public $modelClass = 'models\Teacher';
    public $dataFile = 'tests/_data/teachers.php';

    public $depends = [
    ];
}