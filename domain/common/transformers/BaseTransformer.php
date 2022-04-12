<?php

namespace transformers;

use actions\BaseAction;

abstract class BaseTransformer
{
	public BaseAction $action; 
	
	public function __construct(BaseAction $action)
	{
		$this->action = $action;
	}

	/**
	 * Function returning transformed data
	 *
	 * @return array
	 */
	abstract public function transform(): array;

	/**
	 * Array of (string) dynamic rbac rules to return to user
	 * Such as 'canCreateResource', 'isAuthor', 'canDeletePost'
	 *
	 * @return array
	 */
	public function rbacRules(): array
	{
		return [];
	}
}