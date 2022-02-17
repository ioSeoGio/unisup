<?php

namespace actions;

abstract class BaseAction implements \JsonSerializable
{
	public $form;

	abstract public function run(array $post);

	public function jsonSerialize()
	{
		return $this->form->errors;
	}
}