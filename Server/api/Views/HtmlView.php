<?php

	namespace Views;

	class HtmlView extends BaseView
	{
		public function response($responseContent)
		{
			header(HEADER_HTML);


		}

		public function responseError()
		{

		}
	}