<?php

namespace helpers;

use Yii;

class FileHelper 
{
	/**
	 * Gets the folder asias & create it if it doesnt exists
	 *
	 * @param $folderAlias str
	 * @param $autoCreate bool To create dir if such doesnt exist
	 *
	 * @return str Alias of folder
	 */
	public static function getFolderPathByAlias(string $folderAlias, bool $autoCreate = true)
	{
        $path = Yii::getAlias($folderAlias);
        if (!is_dir($path) && $autoCreate) {
            mkdir($path);
        }
        return $path;
	}

	/**
	 * Delete file with checking
	 *
	 * @param $path str
	 *
	 * @return bool
	 */
	public static function deleteFile(string $path)
	{
    	if (file_exists($path)) {
    	    return unlink($path);
    	}
    	return false;
	}
}
