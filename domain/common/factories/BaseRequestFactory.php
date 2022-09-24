<?php declare(strict_types=1);

namespace factories;

use seog\web\RequestAdapterInterface;

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