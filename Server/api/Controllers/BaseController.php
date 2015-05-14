<?php

	namespace Controllers;

	abstract class BaseController extends \BaseRegular
	{
		protected $params; // http form from user
		protected $responseFormat;
		protected $user;
		protected $view;
		protected $result;

		public function __construct($params, $responseFormat)
		{
			parent::__construct();

			$this->result = false;

			$this->params = $params;
			$this->responseFormat = $responseFormat;

			$this->user = $this->objFactory
				->getObjUserValidator()->isValidUser();

			$viewName = '\Views\\' . ucfirst($this->responseFormat) . 'View';

			$this->view = new $viewName();
		}

		public function __destruct()
		{
			$this->view->response($this->result);
		}
	}
