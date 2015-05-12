<?php

	namespace Models\Performers;

	class Car extends \BaseRegular
	{
		public function getCarList()
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getCarList()')
				->execute([])->getResult();
		}

		public function getCarDetails($idCar)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getCarDetails(:idCar)')
				->execute([':idCar' => $idCar])->getResult()[0];
		}

		public function addOrder($params)
		{
			return (bool) $this->objFactory->getObjDatabase()
				->setQuery('CALL addOrder(:idCar, :userName,
						:userSurname, :payMethod)')
				->execute([
					':idCar' => $params[0],
					':userName' => $params[1],
					':userSurname' => $params[2],
					':payMethod' => $params[3]])->getResult()[0]['result'];
		}

		public function getCarListByFilter($params)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL getCarByParams(:model, :year, :engine,
				        :color, :speed, :price)')
				->execute([
					':model' => $params[0],
					':year' => $params[1],
					':engine' => $params[2],
					':color' => $params[3],
					':speed' => $params[4],
					':price' => $params[5]])->getResult();
		}
	}