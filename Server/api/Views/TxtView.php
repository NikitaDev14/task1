<?php

	namespace Views;

	class TxtView extends BaseView
	{
		public function response($responseContent)
		{
			header(HEADER_TXT);

			print_r($responseContent);
		}
		public function responseError()
		{

		}
	}