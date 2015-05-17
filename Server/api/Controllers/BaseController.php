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

			$this->result =
				new \Models\Utilities\RestException('Forbidden', 403);

			$this->params = $params;
			$this->responseFormat = $responseFormat;

			$this->user = $this->objFactory
				->getObjUserValidator()->isValidUser();

			$viewName = '\Views\\' . ucfirst($this->responseFormat) . 'View';

			$this->view = new $viewName();
		}

		public function __destruct()
		{
			if($this->result instanceof \Models\Utilities\RestException)
			{
				$this->view->responseError($this->result);
			}
			else
			{
				$this->view->response($this->result);
			}
		}
	}