<?php 

namespace seog\db;

interface QueryInterface
{
	public function one(): ?object;
	public function all(): array;
	public function each(): \Iterator;
	public function where(): self;
	public function with(): self;
	public function limit(): self;
}
