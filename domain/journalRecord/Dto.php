<?php

namespace domain\journalRecord;

class Dto
{
    public ?int $id;
    public ?string $topic;
    public ?int $class_type;
    public ?int $journal_id;
    public ?int $teacher_id;
    public ?int $group_id;
    public ?string $lesson_at;

    public ?string $created_at;
    public ?string $updated_at;
}
