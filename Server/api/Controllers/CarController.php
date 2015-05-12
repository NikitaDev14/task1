<?php

	namespace Controllers;

	class CarController extends BaseController
	{
		public function getCarList()
		{
			$result = false;

			var_dump($_COOKIE);

			if(true === (bool) $this->user)
			{
				$result = $this->objFactory->getObjCar()->getCarList();
			}

			//$this->view->response($result);
		}
	}