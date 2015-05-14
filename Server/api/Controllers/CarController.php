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

		public function postOrder()
		{
			if(true === (bool) $this->user)
			{
				$this->result = $this->objFactory->getObjCar()
					->addOrder
					(
						$this->user[0]['idUser'],
						$this->params['idCar'],
						$this->params['payMethod']
					);
			}
		}
	}
