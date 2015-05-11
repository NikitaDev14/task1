<?php

	namespace Models\Performers;

	class User extends \BaseRegular
	{
		/**
		 * add new name, surname, email, password
		 * @return (newId)
		 */
		public function addUser($email, $name, $surname, $password)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_addUser(:email, :name, :surname, :password)')
				->execute([
					':email' => $email,
					':name' => $name,
					':surname' => $surname,
					':password' => $password])
				->getResult()[0]['newId'];
		}

		/**
		 * @return if $email is set true
		 * false otherwise
		 */
		public function getUserByEml($email)
		{
			return (bool) $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getEmplByEml(:email)')
				->execute([':email' => $email])->getResult();
		}

		/**
		 * check existing pair $email and $password
		 * @return (idUser)
		 */
		public function getUserByEmlPass($email, $password)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getEmplByEmlPass(:email, :password)')
				->execute([':email' => $email, ':password' => $password])
				->getResult()[0]['idUser'];
		}

		/**
		 * check session of specified user
		 * @return (idUser, Name, Surname)
		 */
		public function getUserBySession($idUser, $sessionId)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getEmplByCookie(:idUser, :sessionId)')
				->execute([':idUser' => $idUser, ':sessionId' => $sessionId])
				->getResult();
		}

		/**
		 * set new session for specified user
		 * @return bool (result)
		 */
		public function sessionStart($idUser, $sessionId)
		{
			return (bool) $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_sessionStart(:idUser, :sessionId)')
				->execute([':idUser' => $idUser, ':sessionId' => $sessionId])
				->getResult();
		}

		/**
		 * stop session of specified user
		 * @return bool (result)
		 */
		public function sessionDestroy($idUser)
		{
			return (bool) $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_sessionDestroy(:idUser)')
				->execute([':idUser' => $idUser])->getResult();
		}
	}