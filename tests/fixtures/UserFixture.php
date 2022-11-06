<?php declare(strict_types=1);

namespace tests\fixtures;
 
use seog\test\BaseActiveFixture;
 
class UserFixture extends BaseActiveFixture
{
    public $modelClass = 'models\User';
    public $dataFile = 'tests/_data/users.php';

    public $depends = [
    ];
}
