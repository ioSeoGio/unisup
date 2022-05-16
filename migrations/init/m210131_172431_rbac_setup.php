<?php

namespace app\migrations\init;

use Yii;
use app\rbac\AdminRule;
use app\rbac\ModeratorRule;
use app\rbac\Rbac;
use app\rbac\UserRule;
use seog\db\Migration;

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

        $admin = $auth->createRole(Rbac::ADMIN);
        $admin->ruleName = $adminRule->name;
        $auth->add($admin);

        $moderator = $auth->createRole(Rbac::MODERATOR);
        $moderator->ruleName = $moderatorRule->name;
        $auth->add($moderator);

        $user = $auth->createRole(Rbac::USER);
        $user->ruleName = $userRule->name;
        $auth->add($user);
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->getRole(Rbac::USER);
        $moderator = $auth->getRole(Rbac::MODERATOR);
        $admin = $auth->getRole(Rbac::ADMIN);
        $userRule = $auth->getRule(Rbac::USER_RULE);
        $moderatorRule = $auth->getRule(Rbac::MODERATOR_RULE);
        $adminRule = $auth->getRule(Rbac::ADMIN_RULE);

        $auth->remove($user);
        $auth->remove($moderator);
        $auth->remove($admin);

        $auth->remove($userRule);
        $auth->remove($moderatorRule);
        $auth->remove($adminRule);
    }
}
