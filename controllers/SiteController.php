<?php

namespace app\controllers;

use domain\login\LoginCredentialsDto;
use factories\RequestFactory;
use models\WorkReportType;
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

        private RequestFactory $requestFactory,
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
            'only' => [],
            'except' => ['test', 'login', 'index'],
        ]);
    }

    public function verbActions()
    {
        return [
            'index' => ['get'],
            'login' => ['post'],
        ];
    }
    
    public function actionIndex()
    {
        return 'Hello world!';
    }

    public function actionTest()
    {
//        $model = new WorkReportType();
//        $model->serial_number = 1;
//        $model->type = \domain\workReport\WorkReportType::SCIENTIFIC;
//        $model->description = 'Выкананне праграмы;па якой універсітэт з ’яўляецца галаўной арганізацыяй (на ўсіх выканаўцаў)';
//        $model->brest_points = 60;
//        $model->belarus_points = 50;
//        $model->foreign_points = 30;
//        $model->save();
//        dd($model->asArray());
        // Yii::$app->rbacHandler->addRule('canSTFU');
        // Yii::$app->messageHandler->add('error', 'Test');
    }

    public function actionLogin()
    {
        $dto = $this->requestFactory->makeDto(LoginCredentialsDto::class);
        if ($this->loginForm->load($dto) && $this->loginForm->validate()) {
            $result = $this->loginAction->run($dto);
            return (new LoginTransformer($result))->makeResponse();
        }
        return $this->loginForm;
    }
}
