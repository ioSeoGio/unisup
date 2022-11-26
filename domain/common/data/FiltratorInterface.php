<?php declare(strict_types=1);

namespace data;

use yii\data\ActiveDataProvider;

interface FiltratorInterface
{
	public function search(): ActiveDataProvider;
}
