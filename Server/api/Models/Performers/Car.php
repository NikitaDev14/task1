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
				->setQuery('CALL rest_getCarDetails(:idCar)')
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

		public function getCarListByFilter($filter)
		{
			return $this->objFactory->getObjDatabase()
				->setQuery('CALL rest_getCarByFilter(:model, :year, :engine,
				        :color, :speed, :price)')
				->execute([
					':model' => substr($filter[0], 2),
					':year' => substr($filter[1], 2),
					':engine' => substr($filter[2], 2),
					':color' => substr($filter[3], 2),
					':speed' => substr($filter[4], 2),
					':price' => substr($filter[5], 2)])->getResult();
		}
	}