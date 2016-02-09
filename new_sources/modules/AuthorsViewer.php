<?php

class AuthorsViewer {

	public function generateViewForCompetition($competition) {
		$html =  "<h1>".$competition['name']."</h1>";
		$html .=  "<ul>";

		$results = $this->getAllRobotsForCompetition($competition);
		$count = 1;
		foreach ($results as $result) {
			$html .= "<li>";
			$html .= "#".$count." Robot <a href='index.php?page=robotinfo&item=".$result['id_robot']."'>".$result['name']."</a>";
			$html .= " (".$result['name_surname'].") ".$result['town'];

			switch($result['state']) {
				case "CR": 
					$html .= " <img src='images/icon/czech.gif' alt='czech'>";
					break;
				case "AUT": 
					$html .= " <img src='images/icon/polska.gif' alt='czech'>";
					break;
				case "GER": 
					$html .= " <img src='images/icon/ger.gif' alt='czech'>";
					break;
				case "PL": 
					$html .= " <img src='images/icon/polska.gif' alt='czech'>";
					break;
			}
			
			if ($robot['fei'] == 1){
				$html .= " <img src='images/icon/fei.gif' alt='fei'>";
			}

			if ($robot['arduino'] == 1){
				$html .= " <img src='images/icon/ardu.gif' alt='arduino'>";
			}

			if ($robot['lego'] == 1){
				$html .= " <img src='images/icon/lego.gif' alt='lego'>";
			}

			$html .= "</li>";
		}

		$html .=  "</ul>";

		echo $html;
	}

	private function getAllRobotsForCompetition($competition) {
		$resultsTableName = $this->getResultsTableName($competition['id_type_of_competition']);
		$sql = mysql_query("SELECT * FROM ".$resultsTableName." res "
						   ."INNER JOIN robot rob ON rob.id_robot = res.id_robot "
						   ."INNER JOIN author auth ON auth.id_author = rob.id_author "
						   ."WHERE res.id_competition=".$competition['id']) or die(mysql_error());
		
		$results = array();
		while($res = mysql_fetch_array($sql)) {
			array_push($results, $res);
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


}

?>
