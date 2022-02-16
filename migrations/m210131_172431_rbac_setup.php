<?php

use app\parent\db\Migration;;

use app\rbac\UserRule;
use app\rbac\ModeratorRule;
use app\rbac\AdminRule;


class m210131_172431_rbac_setup extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
    
        $adminRule = new AdminRule(); 
        $moderatorRule = new ModeratorRule(); 
        $userRule = new UserRule(); 
        $auth->add($adminRule);
        $auth->add($moderatorRule);
        $auth->add($userRule);

        $admin = $auth->createRole('admin');
        $admin->ruleName = $adminRule->name;
        $auth->add($admin);

        $moderator = $auth->createRole('moderator');
        $moderator->ruleName = $moderatorRule->name;
        $auth->add($moderator);

        $user = $auth->createRole('user');
        $user->ruleName = $userRule->name;
        $auth->add($user);

    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        
        $user = $auth->getRole('user');
        $moderator = $auth->getRole('moderator');
        $admin = $auth->getRole('admin');
        $userRule = $auth->getRule((new UserRule())->name);
        $moderatorRule = $auth->getRule((new ModeratorRule())->name);
        $adminRule = $auth->getRule((new AdminRule())->name);

        $auth->remove($user);
        $auth->remove($moderator);
        $auth->remove($admin);

        $auth->remove($userRule);
        $auth->remove($moderatorRule);
        $auth->remove($adminRule);

        return true;
    }
}
