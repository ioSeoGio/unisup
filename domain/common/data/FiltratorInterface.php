<?php

namespace data;

use seog\web\RequestAdapterInterface;
use yii\data\ActiveDataProvider;

interface FiltratorInterface
{
	public function search(RequestAdapterInterface $request): ActiveDataProvider;	
}
