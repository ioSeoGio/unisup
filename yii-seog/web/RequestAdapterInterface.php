<?php 

namespace yiiseog\web;

interface RequestAdapterInterface
{
	public function getBodyParams();
	public function getQueryParams();
}