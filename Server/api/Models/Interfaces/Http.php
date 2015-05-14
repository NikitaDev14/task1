<?php

	namespace Models\Interfaces;

	class Http
	{
		private static $instance;

		private $headers;

		private function __construct()
		{
			$this->headers = apache_request_headers();
		}

		public static function getInstance()
		{
			if(empty(self::$instance))
			{
				self::$instance = new Http();
			}

			return self::$instance;
		}

		public function getHeaderValue($name)
		{
			if(empty($this->headers[$name]))
			{
				return false;
			}

			return $this->headers[$name];
		}
	}