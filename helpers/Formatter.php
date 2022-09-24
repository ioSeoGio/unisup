<?php declare(strict_types=1);

namespace helpers;

class Formatter
{
	public static function currentDateTime(): string
	{
		return date("Y-m-d H:i:s");
	} 	
}
