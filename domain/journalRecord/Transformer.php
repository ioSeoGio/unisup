<?php 

namespace domain\journalRecord;

use transformers\BaseTransformer;
use models\JournalRecord;

class Transformer extends BaseTransformer
{
    public function __construct(
        private JournalRecord $dto
    ) {}

	public function formatResponse(): mixed
	{
        return $this->dto;
    }
}
