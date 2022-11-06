<?php declare(strict_types=1);

namespace helpers;

class Formatter
{
    public const DATETIME_FORMAT = 'Y-m-d H:i:s';

	public static function currentDateTime(): string
	{
		return date(self::DATETIME_FORMAT);
	} 	
}
