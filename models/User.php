<?php

namespace models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UnprocessableEntityHttpException;

use models\base\User as BaseUser;

/**
 * This class describes an user AR.
 */
class User extends BaseUser
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['timestamp'] = [
            'class' => 'yii\behaviors\TimestampBehavior',
            'value' => function ($event) {
                return date("Y-m-d H:i:s");
            }
        ];

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        $this->guardIsNotAdmin();

        return parent::beforeDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ]);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Makes an access token.
     *
     * @return string
     */
    public static function makeAccessToken()
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates access token
     */
    public function generateAccessToken()
    {
        $this->access_token = self::makeAccessToken();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function isAdmin()
    {
        return $this->id === 1;
    }

    public function guardIsNotAdmin()
    {
        if ($this->isAdmin()) {
            throw new UnprocessableEntityHttpException(
                Yii::t('app', "You can't delete admin.")
            );       
        }
    }
    
}
