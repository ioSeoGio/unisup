<?php
 
namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class UserFixture extends ActiveFixture
{
    public $modelClass = 'models\User';
    public $dataFile = '@tests/fixtures/data/users.php';

    public $depends = [
    ];
}