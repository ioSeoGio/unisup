<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class ClassTypeFixture extends ActiveFixture
{
    public $modelClass = 'models\ClassType';
    public $dataFile = 'tests/_data/class_types.php';

    public $depends = [
    ];
}