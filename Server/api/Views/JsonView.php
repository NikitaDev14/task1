<?php

	namespace Views;

	class JsonView extends BaseView
	{
		public function __construct()
		{
			header(HEADER_JSON);
		}
		public function response($responseContent)
		{
			echo json_encode($responseContent);
		}
		public function responseError(
			\Models\Utilities\RestException $exception)
		{
			parent::sendErrorHeader($exception);

			echo json_encode((string) $exception);
		}
	}