<?php

namespace listeners;

use events\SignupSuccessEvent;

class SignupSuccessEventListener extends BaseEventListener
{
	public function handle(SignupSuccessEvent $event): void
	{
		Yii::$app->session->addFlash(
			'success',
			Yii::t('app', 'Thank you for registration. Please check your inbox for verification email.')
		);

        Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $event->form->user]
            )
            ->setFrom([Yii::$app->params['robotEmail'] => Yii::$app->name . ' robot'])
            ->setTo($event->form->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
	}
}