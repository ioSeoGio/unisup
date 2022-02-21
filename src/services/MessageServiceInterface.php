<?php 

namespace services;

interface MessageServiceInterface
{
	public function add(string $type, string $message): void;
	public function dump(): array;
}