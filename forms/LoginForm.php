<?php

namespace forms;

use domain\login\LoginCredentialsDto;
use domain\user\UserRepository;
use domain\user\UserService;
use factories\DataFactory;
use models\query\UserQuery;
use models\User;
use seog\base\ModelAdapter;
use validators\ValidatorInterface;
use Yii;

/**
 * Login form
 */
class LoginForm extends ModelAdapter implements ValidatorInterface
{
    public $username;
    public $password;

    private $_user;

    public function __construct(
        private UserRepository $repository,
        private UserService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'username' => Yii::t('models', 'Username'),
            'password' => Yii::t('models', 'Password'),
        ]);
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$this->service->validatePassword($this->password, $user)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return $this->getUser();
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    private function getUser()
    {
        if ($this->_user === null) {
            $this->_user = $this->repository->findByUsername($this->username);
        }

        return $this->_user;
    }
}
