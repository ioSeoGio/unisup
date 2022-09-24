<?php declare(strict_types=1);

namespace components;


class MessageHandler implements MessageHandlerInterface
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