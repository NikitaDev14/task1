<?php

	namespace Controllers;

	class UserController extends BaseController
	{
		/**
		 * if user is logged
		 * set response (idUser, Name, Surname, SessionId), false otherwise
		 */
		public function getInfo()
		{
			if(true === (bool) $this->user)
			{
				$this->result = $this->user;
			}

			//$this->view->response($this->result);
        }

        public function getOrders()
        {
            if(true === (bool) $this->user)
            {
               $this->result = $this->objFactory->getObjUser()
	               ->getOrdersByUser($this->user[0]['idUser']);
            }
        }

		/**
		 * get from HTTP form an email and password
		 * if this pair is valid begin session,
		 * set response idUser and SessionId, false otherwise
		 */
		public function putSession()
		{
			$user = $this->objFactory->getObjLoginValidator()
				->setForm($this->params)->isValidForm();

			if (true === (bool) $user)
			{
				$userId = $user[0]['idUser'];

				$sessionId = $this->objFactory->getObjSession()
					->getSessionId();

				$this->objFactory->getObjUser()
					->sessionStart($userId, $sessionId);

				$this->result = ['idUser' => $userId,
					'SessionId' => $sessionId];
			}
		}

		public function deleteSession()
		{
			if(true === (bool) $this->user)
			{
				$this->result = $this->objFactory->getObjUser()
					->sessionDestroy($this->user[0]['idUser']);
			}
		}

		public function postUser()
		{
			$form = $this->objFactory->getObjSignupValidator()
				->setForm($this->params)->isValidForm();

			if(true === $form && false === (bool) $this->user)
			{
				$this->result = $this->objFactory->getObjUser()
					->addUser
					(
						$this->params['name'],
						$this->params['surname'],
						$this->params['email'],
						$this->params['password']
					);
			}
		}
	}