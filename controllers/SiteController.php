<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use seog\rest\Controller as BaseController;

use domain\login\LoginRequestFactory;
use domain\login\LoginForm;
use domain\login\LoginAction;
use domain\login\LoginTransformer;

class SiteController extends BaseController
{
    public function __construct(
        $id, 
        $module, 

        private LoginRequestFactory $loginRequestFactory,
        private LoginForm $loginForm,
        private LoginAction $loginAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function rules()
    {
        return [
            [
                'actions' => ['test', 'index', 'login'],
                'allow' => true,
            ]
        ];
    }

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => ['test'],
            'except' => ['login'],
        ]);
    }

    public function verbs()
    {
        return [
            'class' => VerbFilter::className(),
            'actions' => [
                'login' => ['post'],
                'signup' => ['post'],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return 'Hello world!';
    }

    public function actionTest()
    {
        dd(Yii::$app->user->identity);
        // Yii::$app->rbacHandler->addRule('canSTFU');
        // Yii::$app->messageHandler->add('error', 'Test');
    }

    public function actionLogin()
    {
        $dto = $this->loginRequestFactory->makeDto();
        if ($this->loginForm->load($dto) && $this->loginForm->validate()) {
            $result = $this->loginAction->run($dto);
            return (new LoginTransformer($result))->makeResponse();
        }
        return $this->loginForm;
    }
}
