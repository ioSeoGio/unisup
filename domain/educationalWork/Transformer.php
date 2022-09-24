<?php declare(strict_types=1);


namespace domain\educationalWork;

use transformers\BaseTransformer;
use models\EducationalWorkReport;

class Transformer extends BaseTransformer
{
    public function __construct(
        private EducationalWorkReport $dto
    ) {}

	public function formatResponse(): mixed
	{
        return $this->dto;
    }
}
