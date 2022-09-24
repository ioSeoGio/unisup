<?php declare(strict_types=1);


namespace domain\workReport\scientificWork;

use transformers\BaseTransformer;
use PhpOffice\PhpWord\PhpWord;

class Transformer extends BaseTransformer
{
    const FILENAME = 'ПОКАЗАТЕЛИ научно-исследовательской деятельности.docx';

    public function __construct(
        private PhpWord $document
    ) {}

	public function formatResponse(): mixed
	{
        $this->document->save(
            filename: self::FILENAME,
            download: true
        );
        exit;
    }
}
