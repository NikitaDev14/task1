<?php

	namespace Controllers;

	class CarController extends BaseController
	{
		public function getCarList()
		{
			$result = $this->objFactory->getObjCar()->getCarList();

			$this->view->response($result);
		}

		public function getCarListByFilter()
		{
			$result = $this->objFactory->getObjCar()
				->getCarListByFilter($this->params);
            var_dump($this->params);
			//$this->view->response($result);
		}

		public function getCarDetails()
		{
			$result = $this->objFactory->getObjCar()
				->getCarDetails($this->params[0]);

			//var_dump($result);

			$this->view->response($result);
		}
	}
