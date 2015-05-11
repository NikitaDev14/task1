<?php

	namespace Controllers;

	class UserController extends BaseController
	{
		/**
		 * if user is logged
		 * set response (idUser, Name, Email), false otherwise
		 */
		public function getInfo()
		{
			$result = false;

			if(true === (bool) $this->user)
			{
				$result = $this->user;
			}

			var_dump($result);
		}

		/**
		 * get from HTTP form an email and password
		 * if this pair is valid begin session and set cookie,
		 * set response true, false otherwise
		 */
		public function putSession()
		{
			$formData = $this->objFactory->getObjHttp()
				->setParams($this->form)->getParams();

			$user = $this->objFactory->getObjValidatorLogin()
				->setForm($formData)->isValidForm();

			$result = false;

			if (true === (bool) $user)
			{
				$userId = $user[0]['idEmployee'];

				$sessionId = $this->objFactory->getObjSession()
					->getSessionId();

				$this->objFactory->getObjUser()
					->sessionStart($userId, $sessionId);

				$this->objFactory->getObjCookie()
					->setCookie('id', $userId)
					->setCookie('isAdmin', $user[0]['IsAdmin'])
					->setCookie('session', $sessionId);

				$result = $userId;
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
		}

		/**
		 * delete cookie and session
		 * set response true, false otherwise
		 */
		public function deleteSession()
		{
			$result = false;

			if(true === (bool) $this->user)
			{
				$result = $this->objFactory->getObjUser()
					->sessionDestroy($this->user[0]['idEmployee']);

				$this->objFactory->getObjCookie()
					->deleteCookie('id')
					->deleteCookie('isAdmin')
					->deleteCookie('session');
			}

			$this->objFactory->getObjDataContainer()
				->setParams(['nextPage' => $this->nextPage,
					'result' => $result]);
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