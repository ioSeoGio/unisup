<?php

namespace validators;

interface ValidatorInterface
{
	public function load(array $data): bool;
	public function validate(): bool;
}