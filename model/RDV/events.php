<?php
class Events {

	// trouver les évenements entre deux dates
	public function getEventsBetween($BDD, DateTime $debut, DateTime $fin): array {
		$sql = "SELECT * FROM PriseRDV WHERE debut BETWEEN '{$debut -> format('Y-m-d 00:00:00')}' AND '{$fin -> format('Y-m-d 23:59:59')}'";
		$req = query($BDD, $sql);
		return $req -> fetchAll();
	}

	// trouver les évènements entre deux date indexés par jours 
	public function getEventsBetweenByDay($BDD, DateTime $debut, DateTime $fin): array {

		$events = $this -> getEventsBetween($BDD, $debut, $fin);
		$days= [];
		foreach($events as $event){
			$date = explode(' ', $event['debut'])[0];
			if (!isset($days[$date])){
				$days[$date] = [$event];
			} else {
				$days[$date][] = $event;
			}
		}
		return $days;
	}

	public function getEventsBetweenPers($BDD, DateTime $debut, DateTime $fin, $matricule): array {
		$sql = "SELECT * FROM PriseRDV WHERE matricule = $matricule AND debut BETWEEN '{$debut -> format('Y-m-d 00:00:00')}' AND '{$fin -> format('Y-m-d 23:59:59')}'";
		$req = query($BDD, $sql);
		return $req -> fetchAll();
	}

	public function getEventsBetweenByDayPers($BDD, DateTime $debut, DateTime $fin, $matricule): array {

		$events = $this -> getEventsBetweenPers($BDD, $debut, $fin, $matricule);
		$days= [];
		foreach($events as $event){
			$date = explode(' ', $event['debut'])[0];
			if (!isset($days[$date])){
				$days[$date] = [$event];
			} else {
				$days[$date][] = $event;
			}
		}
		return $days;
	}


	//recuperation  d'un événement
	public function find($BDD, int $idRDV):array {
		$statement = query($BDD, "SELECT * FROM PriseRDV WHERE idRDV = $idRDV");
		return $statement -> fetch();
	}
}

