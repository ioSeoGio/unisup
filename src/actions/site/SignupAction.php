<?php

namespace actions\site;

use dispatchers\EventDispatcherInterface;
use events\signup\SignupSuccessEvent;
use events\signup\SignupFailedEvent;
use forms\SignupForm;

use actions\BaseAction;

class SignupAction extends BaseAction
{
	public function __construct(
		public EventDispatcherInterface $dispatcher
	) {}

	public function run(array $post)
	{
        $this->form = new SignupForm();
        if ($this->form->load($post) && $this->form->signup()) {
        	$this->dispatcher->dispatch(new SignupSuccessEvent($this->form));
        	return true;
        }

        $this->setErrors($this->form);
        $this->dispatcher->dispatch(new SignupFailedEvent($this->form));
    	return false;
	}
}