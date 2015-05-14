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
