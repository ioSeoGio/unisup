<?php

use seog\db\ActiveQueryAdapter;
use seog\db\QueryInterface;
use seog\web\RequestAdapter;
use seog\web\RequestAdapterInterface;

use components\MessageHandler;
use components\MessageHandlerInterface;
use components\RbacHandler;
use components\RbacHandlerInterface;
use dispatchers\EventDispatcherInterface;
use dispatchers\SimpleEventDispatcher;


use domain\login\LoginSuccessEvent;
use domain\login\LoginSuccessEventListener;

use domain\user\Creator as UserCreator;
use domain\user\Deleter as UserDeleter;
use domain\user\Repository as UserRepository;
use domain\user\Updater as UserUpdater;
use models\query\UserQuery;

use domain\teacher\Creator as TeacherCreator;
use domain\teacher\Deleter as TeacherDeleter;
use domain\teacher\Repository as TeacherRepository;
use domain\teacher\Updater as TeacherUpdater;
use models\query\TeacherQuery;

return [
    'singletons' => [
	    RequestAdapterInterface::class => RequestAdapter::class,
	    QueryInterface::class => ActiveQueryAdapter::class,

	    MessageHandlerInterface::class => MessageHandler::class,
	    RbacHandlerInterface::class => RbacHandler::class,

	    EventDispatcherInterface::class => function () {
	        return new SimpleEventDispatcher([
	            LoginSuccessEvent::class => [LoginSuccessEventListener::class],
	        ]);
	    },


	    UserCreator::class => function () {
	        return new UserCreator(new UserQuery);
	    },
	    UserDeleter::class => function () {
	        return new UserDeleter(new UserQuery);
	    },
	    UserRepository::class => function () {
	        return new UserRepository(new UserQuery);
	    },
	    UserUpdater::class => function () {
	        return new UserUpdater(new UserQuery);
	    },

	    TeacherCreator::class => function () {
	        return new TeacherCreator(new TeacherQuery);
	    },
	    TeacherDeleter::class => function () {
	        return new TeacherDeleter(new TeacherQuery);
	    },
	    TeacherUpdater::class => function () {
	        return new TeacherUpdater(new TeacherQuery);
	    },
	],
];
