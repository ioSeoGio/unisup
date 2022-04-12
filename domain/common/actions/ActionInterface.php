<?php

namespace actions;

interface ActionInterface
{
	public function run(object $dto): mixed;
}
