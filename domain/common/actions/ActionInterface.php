<?php declare(strict_types=1);

namespace actions;

interface ActionInterface
{
	public function run(object $dto): mixed;
}
