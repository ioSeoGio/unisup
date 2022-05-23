<?php

namespace domain\educationalWork;

class Dto
{
	public ?string $description;
	public ?string $level;
	public ?int $type_id;
	public ?array $teachers = [];
}
