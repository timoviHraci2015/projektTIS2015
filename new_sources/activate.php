<?php
	require_once("config.php");
	require_once("functions.php");
	
	openMySQL($host, $user, $passwd, $db);
	
	$sql_hash = mysql_query("select * from activation where hash = '".mysql_real_escape_string($_GET['hash'])."'");
	echo mysql_real_escape_string($_GET['hash']);
	echo "____HHHH";
	if (mysql_num_rows($sql_hash) > 0) {
		$a_hash = mysql_fetch_object($sql_hash);
		// po verigikaciu mailu nastav show = 1! NEDOPRACOVANE
		// MYSQL UPDATE FOR TABLE `AUTHOR`-este neexistuje kolonka 'show',`ROBOT` show = 1,  	
		@mysql_query("delete from activation where hash = '".mysql_real_escape_string(secure($_GET['hash']))."'");
		//header("Location: index.php?id=inf&action=activate");
		redir("index.php?page=notice&action=active");
	} else {
		//header("Location: index.php?id=inf&action=hasherror");
		//redir("index.php?page=notice&action=inacitve");
	}
?>