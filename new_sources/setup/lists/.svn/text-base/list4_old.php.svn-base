<?php
	require_once("../config.php");
	require_once("../functions.php");
?>
<html>
	<head>
		<title>:: ISTROBOT 2013 - Voľná Jazda ::</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Robot, robotika, Istrobot" />	
		<meta name="description" content="Istrobot robotics competition" />
		<meta name="author" content="Copyright © 2012 robotika.sk, All Rights Reserved." />
		<link Rel=StyleSheet href="list.css" type="text/css">	
	</head>
	
	<body>
		<div class="body_bg">
			<div class = "heading">
				<img src="../images/logo.png" alt="Istrobot logo">
				<h3>Voľná jazda</h3>
				Free style
				<br/><br/>
				<TABLE class="data">
					<TR><TH class="num">č</TH><TH>Súťažiaci</TH><TH>Potlesk / Applaus</TH><TH>Poznámky</TH><TH>Poradie</TH></TR>
					<TR><TD class="num">&nbsp;</TD><TH class="mutal">Robot name</TH><TH>[dB]</TH><TH class="mutal">Remarks</TH><TH class="mutal">Order</TH></TR>
					<?php
						
						openMySQL($host, $user, $passwd, $db);
						$sql_year = mysql_query("SELECT year FROM competition_year");
						$item = mysql_fetch_object($sql_year);
						$year = $item->year;
						$sql = mysql_query("SELECT robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 4 AND category_tag.year = ".$year." ORDER BY category_tag.start_num ASC") or die(mysql_error());
						while ($robot = mysql_fetch_object($sql)) {
							echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH><TD></TD><TD></TD><TD></TD></TR>";
						}
					?>
				</TABLE>
			</div>
		</div>	
	</body>	
</html>