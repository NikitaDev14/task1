<?php

	namespace Controllers;

	abstract class BaseController extends \BaseRegular
	{
		protected $params; // http form from user
		protected $responseFormat;
		protected $user;
		protected $view;

		public function __construct($params, $responseFormat)
		{
			parent::__construct();

			$this->params = $params;
			$this->responseFormat = $responseFormat;

			$this->user = $this->objFactory
				->getObjUserValidator()->isValidUser();

			$viewName = '\Views\\' . ucfirst($this->responseFormat) . 'View';

			$this->view = new $viewName();
		}
	}