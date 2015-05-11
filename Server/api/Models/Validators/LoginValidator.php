<?php

	namespace Models\Validators;

	class LoginValidator extends \BaseSingleton
	{
		private static $instance;
		private $form; // data from HTTP form

		public static function getInstance()
		{
			if(empty(self::$instance))
			{
				self::$instance = new LoginValidator();
			}

			return self::$instance;
		}

		public function setForm($form)
		{
			$this->form = $form;

			return self::$instance;
		}

		/**
		 * @return (idUser) if he's valid
		 * otherwise false
		 */
		public function isValidForm()
		{
			if (isset($this->form['email'], $this->form['password']))
			{
				$result = $this->objFactory->getObjUser()
					->getUserByEmlPass
					(
						$this->form['email'],
						$this->form['password']
					);
			}
			else
			{
				$result = false;
			}

			return $result;
		}
	}