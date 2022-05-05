<?php

namespace transformers;

abstract class BaseTransformer implements \JsonSerializable
{
	abstract public function jsonSerialize(): mixed;

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
