<?php

namespace src\models\base;

use yii\db\ActiveRecord;


class User extends ActiveRecord
{
    const ROLE_USER = 1;
    const ROLE_MODERATOR = 90;
    const ROLE_ADMIN = 100;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    public function getRoles()
    {
        return [
            self::ROLE_USER => Yii::t('app', 'User'),
            self::ROLE_MODERATOR => Yii::t('app', 'Moderator'),
            self::ROLE_ADMIN => Yii::t('app', 'Admin'),
        ];
    }

    public function getStatuses()
    {
        return [
            self::STATUS_DELETED => Yii::t('app', 'Deleted'),
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
        ];
    }

    /**
     * Be careful editing this function, migration of user table uses this
     *
     * @return {desc}
     */
    public static function generateAccessToken()
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }
}