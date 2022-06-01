<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class DisciplineFixture extends ActiveFixture
{
    public $modelClass = 'models\Discipline';
    public $dataFile = 'tests/_data/disciplines.php';

    public $depends = [
    ];
}
