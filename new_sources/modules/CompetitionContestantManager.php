<?php

class CompetitionContestantsManager {
	
	public static function addRobotToCompetition($competitionId, $robotId) {
		$sql = "INSERT INTO competitions_contestants (competition_id, robot_id) VALUES (".$competition_id.", ".$robotId.")"
		mysql_query($sql) or die(mysql_error());
	}

	public static function removeRobotFromCopetition($competitionId, $robotId) {
		$sql = "DELETE FROM competitions_contestants WHERE competition_id='".$competitionId."' and robot_id='".$robotId."'";
		mysql_query($sql) or die(mysql_error());
	}

}

?>