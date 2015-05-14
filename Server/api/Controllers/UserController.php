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
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$form = $this->objFactory->getObjValidatorSignup()
				->setForm($formData)->isValidForm();

			$result = false;

			if(true === (bool) $this->admin && true === $form)
			{
				$result = $this->objFactory->getObjUser()
					->addUser
					(
						$formData['name'],
						$formData['email'],
						$formData['password'],
						(bool) $formData['isAdmin']
					);
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}
	}
