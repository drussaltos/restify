<?php

namespace goldencode\Bitrix\Restify\Formatter;

use CFile;

class FileFormatter implements FormatterInterface {
	/**
	 * Get bitrix file
	 * @param string|int $fileId
	 * @return array
	 */
	public static function format($fileId)
	{
		$rawFile = CFile::GetFileArray($fileId);

		$selectFields = [
			'ID',
			'SRC',
			'HEIGHT',
			'WIDTH',
			'FILE_SIZE',
			'CONTENT_TYPE',
			'ORIGINAL_NAME',
			'DESCRIPTION'
		];
		
		if ($_SERVER['HTTP_HOST'] == 'bitrix.kosmoplus.com') {
		  $protocol = 'https';
		} else {
		  $protocol = $_SERVER['REQUEST_SCHEME'];
		}

		$file = [];
		foreach ($selectFields as $field)
			$file[$field] = $rawFile[$field];
		
		//$file['SRC'] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $file['SRC'];
		$file['SRC'] = $protocol . '://' . $_SERVER['HTTP_HOST'] . $file['SRC'];
		

		return $file;
	}
}
