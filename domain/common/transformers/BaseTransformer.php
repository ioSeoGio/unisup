<?php declare(strict_types=1);

namespace transformers;

abstract class BaseTransformer
{
	public function makeResponse(): mixed
	{
		$this->formatRbacRules();
		return $this->formatResponse();
	}

	protected function formatRbacRules(): void
	{
		foreach (self::rbacRules() as $rbacRuleName => $userCan) {
			if ($userCan) {
				\Yii::$app->rbacService->addRule($rbacRuleName);
			}
		}
	}

	/**
	 * Array of (string) dynamic rbac rules to return to user
	 * Such as 'canCreateResource', 'isAuthor', 'canDeletePost'
	 *
	 * @return array
	 */
	protected function rbacRules(): array
	{
		return [];
	}
	
	abstract protected function formatResponse(): mixed;
}
