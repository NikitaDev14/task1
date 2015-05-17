<?php
	function __autoload($className)
	{
		$fileName = str_replace('\\', '/', $className . '.php');

		if(!file_exists($fileName))
		{
			throw new \Models\Utilities\RestException('Bad Request', 400);
		}

		require_once $fileName;
	};

	function exceptionErrorHandler($errno, $errstr, $errfile, $errline)
	{
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	};

	set_error_handler('exceptionErrorHandler');