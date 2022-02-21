<?php 

namespace services;

interface RbacServiceInterface
{
	public function addRule(string $name): void;
	public function dump(): array;
}