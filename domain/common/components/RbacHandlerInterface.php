<?php declare(strict_types=1);


namespace components;

interface RbacHandlerInterface
{
	public function addRule(string $name): void;
	public function dump(): array;
}