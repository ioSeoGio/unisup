<?php declare(strict_types=1);

namespace domain\documentBuilder;

interface DocumentBuilderInterface
{
	public function build(): mixed;
}