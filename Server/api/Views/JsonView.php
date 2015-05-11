<?php

	namespace Views;

	class JsonView extends BaseView
	{
		public function response($responseContent)
		{
			header(HEADER_JSON);

			echo json_encode($responseContent);
		}
		public function responseError()
		{

		}
	}