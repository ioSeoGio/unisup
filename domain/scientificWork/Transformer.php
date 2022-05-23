<?php 

namespace domain\scientificWork;

use transformers\BaseTransformer;
use models\ScientificWorkReport;

class Transformer extends BaseTransformer
{
    public function __construct(
        private ScientificWorkReport $dto
    ) {}

	public function formatResponse(): mixed
	{
        return $this->dto;
    }
}
