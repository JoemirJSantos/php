<?php

class Sql extends PDO{

	public function __construct(){
		// Conectando no banco
		$this->conn = new PDO("mysql:dbname=dbRegulus;host=localhost", "root","");
	}


	//metodo para quando passar Mais de um Paramentro na clausura where
	private function setParams($statment, $parameters =  array()){

		foreach ($parameters as $key => $value) {
			$this->setParam($key, $value); 
		}
	}

	//metodo para quando Passar um Paramentro na clausura where

	private function setParam($statment,$key, $value){

		$this->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


}

?>