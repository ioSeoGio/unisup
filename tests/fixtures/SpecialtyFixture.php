<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class SpecialtyFixture extends ActiveFixture
{
    public $modelClass = 'models\Specialty';
    public $dataFile = 'tests/_data/specialities.php';

    public $depends = [
    ];
}