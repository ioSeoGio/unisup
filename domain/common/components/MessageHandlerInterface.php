<?php 

namespace components;

interface MessageHandlerInterface
{
	public function add(string $type, string $message): void;
	public function dump(): array;
}