<?php declare(strict_types=1);


namespace domain\methodicalWork;

use transformers\BaseTransformer;
use models\MethodicalWorkReport;

class Transformer extends BaseTransformer
{
    public function __construct(
        private MethodicalWorkReport $dto
    ) {}

	public function formatResponse(): mixed
	{
        return $this->dto;
    }
}
