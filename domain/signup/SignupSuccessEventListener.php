<?php

namespace domain\signup;

use events\EventInterface;
use listeners\BaseEventListener;

class SignupSuccessEventListener extends BaseEventListener
{
	public function handle(EventInterface $event): void
	{
		Yii::$app->session->addFlash(
			'success',
			Yii::t('app', 'Thank you for registration. Please check your inbox for verification email.')
		);

        Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => User::findOne(1)]
            )
            ->setFrom([Yii::$app->params['robotEmail'] => Yii::$app->name . ' robot'])
            ->setTo($event->form->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
	}
}