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

		$file = [];
		foreach ($selectFields as $field)
			$file[$field] = $rawFile[$field];
		
		if (isset($_SERVER['HTTPS']))
    		$scheme = $_SERVER['HTTPS'];
		else
    		$scheme = '';
		if (($scheme) && ($scheme != 'off')) $scheme = 'https';
		else $scheme = 'http';
		
		$file['SRC'] = $scheme . '://' . $_SERVER['HTTP_HOST'] . $file['SRC'];

		return $file;
	}
}
