<?php declare(strict_types=1);

namespace helpers;

use Yii;

class FileHelper 
{
	/**
	 * Gets the folder alias & create it if it doesn't exist
	 */
	public static function getFolderPathByAlias(string $folderAlias, bool $autoCreate = true): string
	{
        $path = Yii::getAlias($folderAlias);
        if (!is_dir($path) && $autoCreate) {
            mkdir($path);
        }
        return $path;
	}

	/**
	 * Delete file with checking
	 */
	public static function deleteFile(string $path): bool
	{
        return file_exists($path) && unlink($path);
	}
}
