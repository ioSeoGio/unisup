<?php declare(strict_types=1);

namespace models\base;

use seog\db\ActiveRecordAdapter;

class User extends ActiveRecordAdapter
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
}
