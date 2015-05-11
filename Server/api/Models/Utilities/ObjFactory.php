<?php

	namespace Models\Utilities;

	/**
	 * makes objects with set parameters
	 */
	class ObjFactory
	{
		private static $database;
		private static $instance;

		private function __construct() {}

		public static function getInstance()
		{
			if (empty(self::$instance))
			{
				self::$instance = new ObjFactory();
			}

			return self::$instance;
		}

		public function getObjDatabase()
		{
			if (empty(self::$database))
			{
				self::$database = new \Models\Interfaces\Database
				(
					DB_NAME, DB_HOST, DB_USER, DB_PASS
				);
			}

			return self::$database;
		}

		public function getObjSignupValidator()
		{
			return \Models\Validators\SignupValidator::getInstance();
		}

		public function getObjLoginValidator()
		{
			return \Models\Validators\LoginValidator::getInstance();
		}

		public function getObjUserValidator()
		{
			return \Models\Validators\UserValidator::getInstance();
		}

		public function getObjSession()
		{
			return \Models\Interfaces\Session::getInstance();
		}

		public function getObjCookie()
		{
			return new \Models\Interfaces\Cookie(COOKIE_EXPIRE);
		}

		public function getObjUser()
		{
			return new \Models\Performers\User();
		}
	}