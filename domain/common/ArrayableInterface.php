<?php declare(strict_types=1);

namespace domain\common;

interface ArrayableInterface
{
	public function asArray(): array;
}