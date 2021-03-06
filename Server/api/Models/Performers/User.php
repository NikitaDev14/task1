<?php

	namespace Models\Performers;

	class User extends \BaseRegular
	{
		/**
		 * add new name, surname, email, password
		 * @return (newId)
		 */
		public function addUser($name, $surname, $email, $password)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_addUser(:name, :surname,
												:email, :password)')
				->execute([
					':name' => $name,
					':surname' => $surname,
					':email' => $email,
					':password' => $password])
				->getResult()[0]['newId'];
        }

        public function getOrdersByUser($idUser)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getOrdersByUser(:idUser)')
				->execute([':idUser' => $idUser])->getResult();
		}

		/**
		 * @return if $email is set true
		 * false otherwise
		 */
		public function getUserByEmail($email)
		{
			return (bool) $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getUserByEmail(:email)')
				->execute([':email' => $email])->getResult();
		}

		/**
		 * check existing pair $email and $password
		 * @return (idUser)
		 */
		public function getUserByEmailPassw($email, $password)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getUserByEmailPassw(:email, :password)')
				->execute([':email' => $email, ':password' => $password])
				->getResult();
		}

		/**
		 * check session of specified user
		 * @return (idUser, Name, Surname)
		 */
		public function getUserBySession($idUser, $sessionId)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getUserBySession(:idUser, :sessionId)')
				->execute([':idUser' => $idUser,
					':sessionId' => $sessionId])->getResult();
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
