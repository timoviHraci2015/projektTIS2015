<?php
	require_once("config.php");

	function openMySQL($host, $user, $pass, $db) {
		$link  = mysql_connect($host, $user, $pass) or die("Nejde sa pripojit k MySQL: " . mysql_error());
		$dbsel = mysql_select_db($db, $link) or die("Nejde vybrat databazu: ". mysql_error());
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_connection=utf8");
	}


?>
