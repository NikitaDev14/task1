<?php

	namespace Controllers;

	class CarController extends BaseController
	{
		public function getCarList()
		{
			$this->result = $this->objFactory->getObjCar()->getCarList();
		}

		public function getCarListByFilter()
		{
			$this->result = $this->objFactory->getObjCar()
				->getCarListByFilter($this->params);
		}

		public function getCarDetails()
		{
			$this->result = $this->objFactory->getObjCar()
				->getCarDetails($this->params[0]);
		}
	}
