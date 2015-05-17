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
		private $exception;

		private function __construct()
		{
			try
			{
				$method = $_SERVER['REQUEST_METHOD'];

				$this->requestString = explode('/',
					$_SERVER['REQUEST_URI'], CLASSNAME_POS_IN_REQUEST+3);

				$this->controller = '\Controllers\\' .
					ucfirst($this->requestString[CLASSNAME_POS_IN_REQUEST]) .
					'Controller';

				$this->action = strtolower($method) .
					ucfirst(explode('.',
						$this->requestString[CLASSNAME_POS_IN_REQUEST+1])[0]);

				$responseFormat = explode('.',
					$this->requestString[count($this->requestString)-1]);

				$this->responseFormat = (empty($responseFormat[1]))?
					DEFAULT_RESPONSE_FORMAT : $responseFormat[1];

				if(!in_array($this->responseFormat,
					unserialize(AVAILABLE_TYPES), true))
				{
					$this->responseFormat = DEFAULT_RESPONSE_FORMAT;

					throw new \ErrorException();
				}

				$this->args = explode('/', $responseFormat[0]);

				switch($method)
				{
					case 'PUT':
					{
						parse_str(file_get_contents('php://input'),
							$this->args);

						break;
					}
					case 'POST':
					{
						$this->args = $_POST;

						break;
					}
				}
			}
			catch(\Exception $e)
			{
				$this->exception =
					new \Models\Utilities\RestException('Bad Request', 400);
			}
		}

		public static function getInstance()
		{
			if(empty(self::$instance))
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
			try
			{
				if($this->exception instanceof \Models\Utilities\RestException)
				{
					throw $this->exception;
				}

				if(method_exists($this->controller, $this->action))
				{
					$objController = new $this->controller(
						$this->args, $this->responseFormat);

					$action = $this->action;

					$objController->$action();
				}
				else
				{
					throw new \Models\Utilities\RestException(
						'Bad Request', 400);
				}

			}
			catch(\Exception $e)
			{
				new \Controllers\ExceptionController(
					$e, $this->responseFormat);
			}
		}
	}