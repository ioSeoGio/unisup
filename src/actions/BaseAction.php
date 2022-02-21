<?php

namespace actions;

use seog\base\Model;

abstract class BaseAction implements \JsonSerializable
{
	public Model $form;
	public array $errors = [];

	abstract public function run(array $post);

	public function jsonSerialize()
	{
		return $this->errors;
	}

	/**
	 * Sets errors from forms to action
	 *
	 * @param $forms Model[]
	 */
	protected function setErrors(Model ...$forms)
	{
		foreach ($forms as $form) {
			$this->errors = array_merge_recursive($this->errors, $form->errors);
		}
	}
}