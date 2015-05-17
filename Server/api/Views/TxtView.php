<?php

	namespace Views;

	class TxtView extends BaseView
	{
		public function __construct()
		{
			header(HEADER_TXT);
		}
		public function response($responseContent)
		{
			print_r($responseContent);
		}
		public function responseError(
			\Models\Utilities\RestException $exception)
		{
			parent::sendErrorHeader($exception);

			echo $exception;
		}
	}