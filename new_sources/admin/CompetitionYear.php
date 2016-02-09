<?php

class CompetitionYear {
	
	public static function getCurrentYear() {
		if(isset($_GET['year'])) {
			$year = $_GET['year'];
		} else {
			$sql = mysql_query("SELECT * FROM competition_year");
			while($res = mysql_fetch_array($sql)) {
				$year = $res['year'];
			}		
		}

		return $year;
	}

}

?>