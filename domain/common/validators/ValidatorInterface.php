<?php declare(strict_types=1);

namespace validators;

interface ValidatorInterface
{
	public function load(array $data): bool;
	public function validate(): bool;
}