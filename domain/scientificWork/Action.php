<?php

namespace domain\scientificWork;

use actions\ActionInterface;

class Action implements ActionInterface
{
	public function __construct(
		private WorkReportDocumentBuilder $documentBuilder,
		private WorkReportDocumentInfoFactory $documentInfoFactory,
	) {}

	public function run(object $requestDto): object
	{
		$documentInfoDto = $this->documentInfoFactory->makeDto($requestDto);
		$document = $this->documentBuilder->build($documentInfoDto); 

    	return $document;
	}
}
