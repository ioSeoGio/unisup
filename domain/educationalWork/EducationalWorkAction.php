<?php

namespace domain\educationalWork;

use actions\ActionInterface;

class EducationalWorkAction implements ActionInterface
{
	public function __construct(
		private EducationalWorkDocumentBuilder $documentBuilder,
		private EducationalWorkDocumentInfoFactory $documentInfoFactory,
	) {}

	public function run(object $requestDto): object
	{
		$documentInfoDto = $this->documentInfoFactory->makeDto($requestDto);
		$document = $this->documentBuilder->build($documentInfoDto); 

    	return $document;
	}
}
