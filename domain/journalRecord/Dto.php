<?php declare(strict_types=1);

namespace domain\journalRecord;

class Dto
{
    public ?string $topic;
    public ?int $class_type;
    public ?int $journal_id;
    public ?int $teacher_id;
    public ?int $group_id;
    public ?string $lesson_at;
}
