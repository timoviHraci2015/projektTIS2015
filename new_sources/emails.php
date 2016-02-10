<?php
	require_once("config.php");
	require_once("functions.php");
	
	openMySQL($host, $user, $passwd, $db);

	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="email_contestants.txt"');

	$query = "SELECT * FROM author "
					."LEFT JOIN robot rob ON rob.id_author = author.id_author "
					."LEFT JOIN competitions_contestants cc ON cc.robot_id = rob.id_robot "
					."LEFT JOIN competitions co ON co.id = cc.competition_id "
					."WHERE co.year='".$_GET['year']."' "
					."GROUP BY author.email";

	$sql = mysql_query($query);
	while ($author = mysql_fetch_object($sql)) {
		echo $author->email."\n";
	}
?>