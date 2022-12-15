<?php declare(strict_types=1);

namespace seog\rest;

use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\rest\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * Configuring authenticator and set cors pre-flight filter in order to deal with api requests right
     * Chrome asking for OPTIONS pre-flight requests, so corsFilter must be set
     *
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        // Configuring authenticator && access
		$behaviors['access'] = $this->access();
        
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];
        
        $behaviors['authenticator'] = [
            'class' => $this->getAuthenticatorClass(),
        ];


		$authConfig = $this->auth();
        $behaviors['authenticator']['only'] = $authConfig['only'];
        $behaviors['authenticator']['except'] = array_merge(['options'], $authConfig['except']);

        return $behaviors;
    }

    public function actions(): array
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    /**
     * Returns the authenticator class
     *
     * @return string
     */
    protected function getAuthenticatorClass(): string
    {
    	return HttpBearerAuth::class;
    }

    /**
     * Return the access rules
     * 	`return [
     *	`	'class' => \yii\filters\AccessControl::className(),
     *	`	'rules' => [
     *	`	]
     *  `];
     *
     * @return array
     */
   	protected function access(): array
    {
        return [
            'class' => \yii\filters\AccessControl::class,
            'rules' => $this->rules(),
        ];
    }

    abstract protected function rules(): array;
   	
   	/**
   	 * Auth configuration of only and except blocks
   	 *
   	 * @return array
   	 */
   	protected function auth(): array
    {
   		return [
   		    'only' => [],
   		    'except' => ['options', 'index', 'read', 'create', 'update', 'delete', '*'],
   		];
   	}

    protected function verbs(): array
    {
        return [
            'class' => VerbFilter::class,
            'actions' => $this->verbActions(),
        ];
    }

    protected function verbActions(): array
    {
        return [
            '*' => ['options'],
            'index' => ['get', 'options'],
            'read' => ['get', 'options'],
            'create' => ['post', 'options'],
            'update' => ['post', 'options'],
            'delete' => ['post', 'options'],
            'get-all' => ['get', 'options'],
            'set-all' => ['patch', 'options'],
        ];
    }
}
