<?php

	namespace Models\Interfaces;

	class Database
	{
		private $db; // database connection
		private $sth; // prepared query

		public function __construct($name, $host, $user, $pass)
		{
			$this->db = new \PDO('mysql:dbname=' . $name .
				';host=' . $host, $user, $pass);
		}

		public function setQuery($query)
		{
			$this->sth = $this->db->prepare($query);

			return $this;
		}

		public function execute($params)
		{
			$this->sth->execute($params);

			return $this;
		}

		public function getResult()
		{
			return $this->sth->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function __destruct()
		{
			$this->db = null;
		}
	}