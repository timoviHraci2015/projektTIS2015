<?php

class CompetitionsResults {

	public function getAllInThisYear() {
		$sql = mysql_query("SELECT * FROM competitions WHERE year='".CompetitionYear::getCurrentYear()."'") or die(mysql_error());
		
		$results = array();
		while($res = mysql_fetch_array($sql)) {
			array_push($results, $res);
		}

		return $results;
	}

	public function generateViewForCompetition($competition) {
		switch($competition['id_type_of_competition']) {
			case 1: echo $this->getViewForCompetitionWithNormalType($competition); return;
			case 2: echo $this->getViewForCompetitionWithNormalType($competition); return;
			case 3: echo $this->getViewForCompetitionWithSpecialType($competition); return;
		}
	}

	private function getViewForCompetitionWithSpecialType($competition) {
		$html = "<h1>".$competition['name']."</h1>";

		$results = $this->getAllResultsForCompetitionWithSpecialType($competition);
		foreach ($results as $result) {
			$html .= "<img style='max-width:100%' src='images/results/".$result['result']."' />";
			$html .= "<br />";
		}
		return $html;
	}

	private function getViewForCompetitionWithNormalType($competition) {
		$table =  "<h1>".$competition['name']."</h1>";
		$table .=  "<table style='width:100%'>";
		$table .=  	"<thead>";
		$table .=      	"<tr>";
		$table .=     		"<th></th>";
		$table .=     		"<th>Meno sutaziacieho</th>";
		$table .=     		"<th>Meno robota</th>";

		for($i=0; $i<$competition['measure_count']; $i++) {
			$table .=     	"<th>Kolo ".($i + 1)."</th>";
		}
		$table .=     	"</tr>";
		$table .=  	"</thead>";
		$table .=  	"<tbody>";

		$results = $this->getAllResultsForCompetition($competition);
		$count = 1;
		foreach ($results as $result) {
			$table .=  "<tr>";
			$table .=  	"<td>".$count.".</td>";
			$table .=  	"<td>".$result['name_surname']."</td>";
			$table .=  	"<td><a href='index.php?page=robotinfo&item=".$result['id_robot']."'>".$result['name']."</td>";

			for($i=0; $i<$competition['measure_count']; $i++) {
				$timeVar = $this->getScoreTableNameForId($competition, $i);
				if($result['bestTime'] == $result[$timeVar]) {
					$table .= "<td><b>".$this->formatResultValue($result[$timeVar])."</b></td>";	
				} else {
					$table .= "<td>".$this->formatResultValue($result[$timeVar])."</td>";	
				}						
			}
			$table .= "</tr>";

			$count = $count + 1;
		}

		$table .= 	"</tbody>";
		$table .= "</table>";

		return $table;
	}

	private function getAllResultsForCompetitionWithSpecialType($competition) {
		$resultsTableName = $this->getResultsTableName($competition['id_type_of_competition']);
		$sql = mysql_query("SELECT * FROM ".$resultsTableName." res "
						   ."WHERE res.id_competition=".$competition['id']) or die(mysql_error());

		$results = array();
		while($res = mysql_fetch_array($sql)) {
			$res['bestTime'] = $this->getBestTime($competition, $res);
			array_push($results, $res);
		}

		return $results;
	}

	private function getAllResultsForCompetition($competition) {
		$resultsTableName = $this->getResultsTableName($competition['id_type_of_competition']);
		$sql = mysql_query("SELECT * FROM ".$resultsTableName." res "
						   ."INNER JOIN robot rob ON rob.id_robot = res.id_robot "
						   ."INNER JOIN author auth ON auth.id_author = rob.id_author "
						   ."WHERE res.id_competition=".$competition['id']) or die(mysql_error());
		
		$results = array();
		while($res = mysql_fetch_array($sql)) {
			$res['bestTime'] = $this->getBestTime($competition, $res);
			array_push($results, $res);
		}

		if(intval($competition['id_type_of_competition']) == 2) {
			usort($results, array("CompetitionsResults","sortByBestScore"));
		} else if(intval($competition['id_type_of_competition']) == 1) {
			usort($results, array("CompetitionsResults","sortByBestTime"));
		}	
		
		return $results;
	}

	private function getResultsTableName($id) {
		switch($id) {
			case 1: return "time_competition";
			case 2: return "point_competition";
			case 3: return "special_competition";
		}
	}

	private function formatResultValue($resultValue) {
		if($resultValue === NULL) {
			return "-";
		}
		return $resultValue;
	}

	private function getBestTime($competition, $result) {
		$times = array();
		for($i=0; $i<$competition['measure_count']; $i++) {
			array_push($times, $result[$this->getScoreTableNameForId($competition, $i)]);
		}

		if(intval($competition['id_type_of_competition']) == 1) {
			usort($times, array("CompetitionsResults","sortTimeNullLast"));
		} else {
			usort($times, array("CompetitionsResults","sortIntNullLast"));
		}

		return $times[0];
	}

	private function getScoreTableNameForId($result, $id) {
		if(intval($result['id_type_of_competition']) == 1) {
			return "time".($id + 1);
		}	

		if(intval($result['id_type_of_competition']) == 2) {
			return "score".($id + 1);
		}
	}

	private static function sortByBestScore($a, $b) {
		return CompetitionsResults::sortIntNullLast($a['bestTime'], $b['bestTime']);
	}

	private static function sortByBestTime($a, $b) {
		return strcmp($a['bestTime'], $b['bestTime']);
	}

	private static function sortIntNullLast($a, $b) {
		if($a === NULL) {
			return 1;
		}
		if($b === NULL) {
			return -1;
		}
		return ($a < $b) ? -1 : (($a > $b) ? 1 : 0);
	}

	private static function sortTimeNullLast($a, $b) {
		if($a === NULL) {
			return 1;
		}
		if($b === NULL) {
			return -1;
		}
		return strcmp($a, $b);
	}

}

?>
