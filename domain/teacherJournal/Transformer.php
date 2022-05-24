<?php 

namespace domain\teacherJournal;

use transformers\BaseTransformer;
use models\TeacherJournal;

class Transformer extends BaseTransformer
{
    public function __construct(
        private TeacherJournal $dto
    ) {}

	public function formatResponse(): mixed
	{
        return $this->dto;
    }
}
