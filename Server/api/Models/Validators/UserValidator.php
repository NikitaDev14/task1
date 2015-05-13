<?php

	namespace Models\Validators;

	class UserValidator extends \BaseSingleton
	{
		private $idUser;
		private $sessionId;
		private $user;

		private static $instance;

		protected function __construct()
		{
			parent::__construct();

			$cookie = $this->objFactory->getObjCookie();

			$this->sessionId = $cookie->getCookie('PHPSESSID');

			$this->user = $this->objFactory->getObjUser()
				->getUserBySession
				(
					$this->sessionId
				);
		}

		public static function getInstance()
		{
			if (empty(self::$instance))
			{
				self::$instance = new UserValidator();
			}

			return self::$instance;
		}

		/**
		 * @return (idUser, Name, Surname)
		 * if session is set and cookie is not expired
		 * otherwise false
		 */
		public function isValidUser()
		{
			return $this->user;
		}
	}