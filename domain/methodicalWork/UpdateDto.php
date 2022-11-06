<?php declare(strict_types=1);

namespace domain\methodicalWork;

class UpdateDto
{
	public ?int $id;
    public ?string $description;
	public ?string $level;
	public ?int $type_id;
	public ?array $teachers = [];
}
