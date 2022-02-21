<?php

namespace services;

use Yii;

class MessageService implements MessageServiceInterface
{
	private array $messages = [];

	public function add(string $type, string $message): void
	{
		if (isset($this->messages[$type])) {
			$this->messages[type][] = $message;
		} else {
			$this->messages[$type] = [$message];
		}
	}

	public function dump(): array
	{
		return $this->messages;
	}
}