<?php declare(strict_types=1);

namespace domain\workReport\scientificWork;

use domain\workReport\DocumentBuilder;
use domain\workReport\DocumentInfoFactory;

class Action
{
	public function __construct(
		private DocumentBuilder $documentBuilder,
		private DocumentInfoFactory $documentInfoFactory,
		private DocumentInfoProvider $documentInfoProvider,
	) {}

	public function run(object $requestDto): object
	{
		$this->documentInfoProvider->setDto($requestDto);
		
		$this->documentInfoFactory->setInfoProvider($this->documentInfoProvider);
		$documentInfoDto = $this->documentInfoFactory->makeDto();
		
		$this->documentBuilder->setDto($documentInfoDto);
		$document = $this->documentBuilder->build();
		
    	return $document;
	}
}
