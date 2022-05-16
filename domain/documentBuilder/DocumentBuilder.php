<?php

namespace domain\documentBuilder;

use domain\educationalWork\EducationalWorkDocumentInfoDto;

abstract class DocumentBuilder
{
	abstract public function build(EducationalWorkDocumentInfoDto $dto): mixed;
}