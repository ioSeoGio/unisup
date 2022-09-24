<?php declare(strict_types=1);


namespace domain\journal;

use transformers\BaseTransformer;
use models\Journal;

class Transformer extends BaseTransformer
{
    public function __construct(
        private Journal $dto
    ) {}

	public function formatResponse(): mixed
	{
        return $this->dto;
    }
}
