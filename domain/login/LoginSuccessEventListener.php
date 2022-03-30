<?php

namespace domain\login;

use Yii;
use events\EventInterface;
use listeners\BaseEventListener;

class LoginSuccessEventListener extends BaseEventListener
{
    public function handle(EventInterface $event): void
	{
        Yii::$app->messageHandler->add(
            'success', 
            Yii::t('app', 'Hello, {username}!', [
                'username' => 'static'
            ])
        );
	}
}
