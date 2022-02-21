<?php

namespace tests\unit\models;

use models\UserIdentity as User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('admin');

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        $user = User::findIdentityByAccessToken('K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238');
        expect_that($user);
        expect($user->username)->equals('admin');

        expect_not(User::findIdentityByAccessToken('non-existing'));        
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('admin'));
        expect_not(User::findByUsername('not-existing-user'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('admin');
        expect_that($user->validateAuthKey('K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r'));
        expect_not($user->validateAuthKey('not-valid-auth-key'));

        expect_that($user->validatePassword('12345678'));
        expect_not($user->validatePassword('not-valid-password'));        
    }

}
