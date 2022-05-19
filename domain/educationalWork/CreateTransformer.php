<?php 

namespace domain\educationalWork;

use transformers\BaseTransformer;
use models\EducationalWorkReport;

class CreateTransformer extends BaseTransformer
{
    public function __construct(
        private EducationalWorkReport $dto
    ) {}

	public function formatResponse(): mixed
	{
        return $this->dto;
    }
}
