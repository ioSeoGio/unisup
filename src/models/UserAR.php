<?php

namespace src\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UnprocessableEntityHttpException;

use src\models\base\User as BaseUser;


/**
 * This class describes an user AR.
 */
class UserAR extends BaseUser
{
    // public $_new_repeat_password;
    // public $_new_password;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['timestamp'] = [
            'class' => 'yii\behaviors\TimestampBehavior',
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
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

            [
                ['_new_password'], 'required', 
                'when' => function ($model) {
                    return $model->_new_repeat_password != null;
                },
            ],
            [
                ['_new_repeat_password'], 'required', 
                'when' => function ($model) {
                    return $model->_new_password != null;
                },
            ],
            [['_new_password', '_new_repeat_password'], 'string', 'min' => 4, 'when' => function ($model) {
                return $model->_new_password != null || $model->_new_repeat_password != null;
            }],
            [['_new_repeat_password'], 'compare', 'compareAttribute' => '_new_password', 'when' => function ($model) {
                return $model->_new_password != null || $model->_new_repeat_password != null;
            }],
        ]);
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
