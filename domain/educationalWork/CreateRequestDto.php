<?php

namespace domain\educationalWork;

class CreateRequestDto
{
	public ?string $description;
	public ?string $level;
	public ?int $teacher_id;
	public ?int $type_id;
}
