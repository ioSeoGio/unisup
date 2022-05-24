<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class GroupFixture extends ActiveFixture
{
    public $modelClass = 'models\Group';
    public $dataFile = 'tests/_data/groups.php';

    public $depends = [
    ];
}