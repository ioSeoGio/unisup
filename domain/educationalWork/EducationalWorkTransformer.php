<?php 

namespace domain\educationalWork;

use transformers\BaseTransformer;
use PhpOffice\PhpWord\PhpWord;

class EducationalWorkTransformer extends BaseTransformer
{
    public function __construct(
        private PhpWord $document
    ) {}

	public function formatResponse(): mixed
	{
        $this->document->save(filename: 'abcd.docx', download: true);
        exit;
    }
}
