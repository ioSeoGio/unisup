<?php declare(strict_types=1);

namespace domain\scientificWork;

class Dto
{
	public ?string $description;
	public ?string $level;
	public ?int $type_id;
	public ?array $teachers = [];
}
