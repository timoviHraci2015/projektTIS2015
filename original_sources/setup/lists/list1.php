<?php
	require_once("../config.php");
	require_once("../functions.php");
?>
<html>
	<head>
		<title>:: ISTROBOT 2013 - Stopár ::</title>
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
				<h3>Kategória Stopár</h3>
				Linefollower
				<br/><br/>
				<TABLE class="data">
					<TR><TH class="num">č</TH><TH>Súťažiaci</TH><TH colspan = 3>Pokus / Run</TH><TH>Poznámky</TH><TH>Poradie</TH></TR>
					<TR><TD class="num">&nbsp;</TD><TH class="mutal">Robot name</TH><TH class="mutal">1<br/>[s]</TH><TH class="mutal">2<br/>[s]</TH><TH class="mutal">3<br/>[s]</TH><TH class="mutal">Remarks</TH><TH class="mutal">Order</TH></TR>
					<?php
						
						openMySQL($host, $user, $passwd, $db);
						$sql_year = mysql_query("SELECT year FROM competition_year");
						$item = mysql_fetch_object($sql_year);
						$year = $item->year;
						$sql = mysql_query("SELECT robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 1 AND category_tag.year = ".$year." ORDER BY category_tag.start_num ASC") or die(mysql_error());
						while ($robot = mysql_fetch_object($sql)) {
							echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD></TR>";
						}
					?>
				</TABLE>
				
				<TABLE class="signat">
					<TR><TD><br/><br/></TD></TR>
					<TR><TD><b>Porotca:</b></TD><TD><b>Podpis:</b></TD></TR>
					<TR><TD>Jury member:</TD><TD>Signature:</TD></TR>
					<TR><TD><br/></TD></TR>
					<TR><TD><b>Dátum</b>/Date:</TD></TR>
				</TABLE>
			</div>
		</div>	
	</body>	
</html>