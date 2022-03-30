<?php 

namespace seog\web;

interface RequestAdapterInterface
{
	public function getBodyParams();
	public function getQueryParams();
}