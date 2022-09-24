<?php declare(strict_types=1);


namespace components;

interface MessageHandlerInterface
{
	public function add(string $type, string $message): void;
	public function dump(): array;
}