<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use seog\rest\Controller as BaseController;

use forms\LoginForm;
use forms\ContactForm;
use forms\SignupForm;
use forms\VerifyEmailForm;
use forms\PasswordResetRequestForm;
use forms\ResendVerificationEmailForm;
use forms\ResetPasswordForm;

use domain\signup\SignupAction;
use domain\signup\UserSignupTransformer;

use domain\login\LoginAction;

class SiteController extends BaseController
{
    public function __construct(
        $id, 
        $module, 
        private SignupAction $signupAction,
        private LoginAction $loginAction,
        private LoginForm $loginForm,
        $config = []
    )
    {
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
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
                [
                    'actions' => ['test', 'index', 'login', 'signup'],
                    'allow' => true,
                ]
            ],
        ];
    }

    protected function auth()
    {
        return array_merge_recursive(parent::auth(), [
            'only' => [],
            'except' => ['login', 'signup', 'test'],
        ]);
    }

    public function verbs()
    {
        return [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['post'],
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
        // return 'Testing page';
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        
        return ['access_token' => 'K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238'];
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if ($this->signupAction->run($this->request->bodyParams)) {
            $this->response->setStatusCode(200);
            return new UserSignupTransformer($this->signupAction);
        }

        $this->response->setStatusCode(422);
        return $this->signupAction;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
