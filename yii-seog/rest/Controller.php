<?php

namespace seog\rest;

use Yii;
use yii\web\Request;
use yii\web\Response;
use yii\rest\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * Configuring authenticator and set cosr pre-flight filter in order to deal with api requests right
     * Chrome asking for OPTIONS pre-flight requests, so corsFilter must be set
     *
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Configuring authenticator && access
		$behaviors['access'] = $this->access();
        $behaviors['authenticator'] = [
            'class' => $this->getAuthenticatorClass(),
        ];

		$authConfig = $this->auth();
        $behaviors['authenticator']['only'] = $authConfig['only'];
        $behaviors['authenticator']['except'] = array_merge(['options'], $authConfig['except']);

        return $behaviors;
    }

    /**
     * Returns the authenticator class
     *
     * @return string
     */
    protected function getAuthenticatorClass()
    {
    	return \yii\filters\auth\HttpBearerAuth::className();
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
   	protected function access()
    {
        return [
            'class' => \yii\filters\AccessControl::class,
            'rules' => $this->rules(),
        ];
    }

    abstract protected function rules();
   	
   	/**
   	 * Auth configuration of only and except blocks
   	 *
   	 * @return array
   	 */
   	protected function auth()
   	{
   		return [
   			'only' => [],
   			'except' => [],
   		];
   	}
}
