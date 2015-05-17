<?php

	namespace Controllers;

	class ExceptionController extends BaseController
	{
		public function __destruct()
		{
			$this->view->responseError($this->params);
		}
	}