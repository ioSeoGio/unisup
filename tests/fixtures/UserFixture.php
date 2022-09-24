<?php declare(strict_types=1);

namespace tests\fixtures;
 
use yii\test\ActiveFixture;
 
class UserFixture extends ActiveFixture
{
    public $modelClass = 'models\User';
    public $dataFile = 'tests/_data/users.php';

    public $depends = [
    ];
}