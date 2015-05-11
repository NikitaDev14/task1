<?php

	namespace Controllers;

	class Router
	{
		private static $instance;

		private $requestString;
		private $controller;
		private $action;
		private $args;
		private $responseFormat;

		private function __construct()
		{
			$this->requestString = explode('/',
				$_SERVER['REQUEST_URI'], CLASSNAME_POS_IN_REQUEST+3);

			$this->controller = '\Controllers\\' .
				ucfirst($this->requestString[CLASSNAME_POS_IN_REQUEST]) .
				'Controller';

			$this->action = strtolower($_SERVER['REQUEST_METHOD']) .
				ucfirst(explode('.',
					$this->requestString[CLASSNAME_POS_IN_REQUEST+1])[0]);

			$responseFormat = explode('.',
				$this->requestString[count($this->requestString)-1]);

			$this->responseFormat = (empty($responseFormat[1]))?
				DEFAULT_RESPONSE_FORMAT : $responseFormat[1];

			$this->args = explode('/', $responseFormat[0]);
		}

		public static function getInstance()
		{
			if (empty(self::$instance))
			{
				self::$instance = new Router();
			}

			return self::$instance;
		}

		/**
		 * application start
		 */
		public function start()
		{
			echo '<pre>';

			var_dump($this->controller, $this->action,
				$this->args, $this->responseFormat,
				$this->requestString);

			echo '</pre>';

			$objController = new $this->controller(
				$this->args, $this->responseFormat);

			$action = $this->action;

			$objController->$action();
		}
	}