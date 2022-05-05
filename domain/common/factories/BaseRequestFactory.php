<?php

namespace factories;

use yiiseog\web\RequestAdapterInterface;

abstract class BaseRequestFactory
{
	protected array $queryParams;
	protected array $bodyParams;

	public function __construct(private RequestAdapterInterface $request) 
	{
		$this->queryParams = $this->request->getQueryParams();
		$this->bodyParams = $this->request->getBodyParams();
	}

	abstract public function makeDto(): object;
}