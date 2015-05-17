<?php

	namespace Views;

	abstract class BaseView
	{
		abstract public function __construct();
		abstract public function response($responseContent);
		abstract public function responseError(
			\Models\Utilities\RestException $exception);

		protected function sendErrorHeader(
			\Models\Utilities\RestException $exception)
		{
			header('HTTP/1.0 ' . $exception->getCode() . ' ' .
				$exception->getMessage());
		}
	}