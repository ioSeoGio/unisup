<?php

namespace factories;

use seog\web\RequestAdapterInterface;

abstract class BaseRequestFactory
{
	protected array $queryParams;
	protected array $bodyParams;

	public function __construct(protected RequestAdapterInterface $request) 
	{
		$this->queryParams = $request->getQueryParams();
		$this->bodyParams = $request->getBodyParams();
	}

	abstract public function makeDto(): object;
}