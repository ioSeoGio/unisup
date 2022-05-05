<?php

namespace yiiseog\rest;

use yii\rest\Serializer as BaseSerializer;

use transformers\BaseTransformer;

class Serializer extends BaseSerializer
{
	/**
	 * {@inheritdoc}
	 */
	public function serialize($data)
	{
		$data = parent::serialize($data);

		if ($data instanceof BaseTransformer) {
			return $this->serializeTransformer($data);
		}

		return $data;
	}

	private function serializeTransformer(BaseTransformer $transformer)
	{
		foreach ($transformer->rbacRules() as $rbacRuleName => $can) {
			if ($can) {
				Yii::$app->rbacService->addRule($rbacRuleName);
			}
		}

		return $transformer->transform();
	}
}