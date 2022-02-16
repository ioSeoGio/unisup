<?php

namespace src\listeners;

use src\events\SignupSuccessEvent;

class SignupSuccessEventListener extends BaseEventListener
{
	public function handle(SignupSuccessEvent $event): void
	{
		Yii::$app->session->addFlash(
			'success',
			Yii::t('app', 'Thank you for registration. Please check your inbox for verification email.')
		);
	}
}