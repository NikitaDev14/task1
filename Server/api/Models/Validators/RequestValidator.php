<?php

	namespace Models\Validators;

	class RequestTypeValidator
	{
		private static $instance;

		private $requestType;



		private function __construct($requestType)
		{
			$this->requestType = $requestType;
		}

		public static function getInstance($requestType)
		{
			if(empty(self::$instance))
			{
				self::$instance = new RequestTypeValidator($requestType);
			}

			return self::$instance;
		}

		public function isValidRequestType()
		{
			return in_array($this->requestType, self::AVAILABLE_TYPES, true);
		}
	}