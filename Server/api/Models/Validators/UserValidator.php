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

			$http = $this->objFactory->getObjHttp();

			$this->idUser = $http->getHeaderValue('user');
			$this->sessionId = $http->getHeaderValue('session');

			$this->user = $this->objFactory->getObjUser()
				->getUserBySession
				(
					$this->idUser,
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