<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yiiseog\rest\Controller as BaseController;

use domain\login\LoginFactory;
use domain\login\LoginForm;
use domain\login\LoginAction;
use domain\login\LoginTransformer;

class SiteController extends BaseController
{
    public function __construct(
        $id, 
        $module, 

        private LoginFactory $loginFactory,
        private LoginForm $loginForm,
        private LoginAction $loginAction,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function access()
    {
        return [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['test', 'index', 'login'],
                    'allow' => true,
                ]
            ],
        ];
    }

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => [],
            'except' => ['login', 'test'],
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
        // Yii::$app->rbacHandler->addRule('canSTFU');
        // Yii::$app->messageHandler->add('error', 'Test');
    }

    public function actionLogin()
    {
        $dto = $this->loginFactory->makeDto();
        if ($this->loginForm->load($dto) && $this->loginForm->validate()) {
            return new LoginTransformer($this->loginAction->run($dto));
        }
        return $this->loginForm;
    }
}
