<?php
	require_once("../config.php");
	require_once("../functions.php");
?>
<html>
	<head>
		<title>:: ISTROBOT 2013 - Sklad Kečupov ::</title>
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
				<h3>Kategória Sklad kečupov</h3>
				Ketchup house
				<br/><br/>
				<TABLE class="list3">
					<?php
						
						openMySQL($host, $user, $passwd, $db);
						$sql_year = mysql_query("SELECT year FROM competition_year");
						$item = mysql_fetch_object($sql_year);
						$year = $item->year;
						$sql = mysql_query("SELECT robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 3 AND category_tag.year = ".$year." ORDER BY category_tag.start_num ASC") or die(mysql_error());
						$poc = mysql_num_rows($sql);
						
						echo "<TR><TH class=\"num\">č</TH><TD></TD>";
						for ($k = 1; $k <= $poc; $k++) {
							echo "<TD class=\"num\">#".$k."</TD>";	
						}
						echo "</TR><TR><TD class=\"num\"></TD><TH class=\"horizontal\"></TH>";
						while ($robot = mysql_fetch_object($sql)) {
							echo "<TH class=\"vertical\">".$robot->name."</TH>";
						}
						echo "</TR>";
						$sql2 = mysql_query("SELECT robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 3 AND category_tag.year = ".$year." ORDER BY category_tag.start_num ASC") or die(mysql_error());
						$poc = mysql_num_rows($sql);
						$i = 1;
						while ($robot = mysql_fetch_object($sql2)) {
							echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH>";
							for ($k = 1; $k <= $poc; $k++) {
								if ($k == $i){
									echo "<TD class=\"shadow\"></TD>";
								} else {
									echo "<TD class=\"num\"></TD>";
								}		
							}
							$i++;
						}
						echo "</TR>";
					?>
				</TABLE>
								
				<TABLE class="signatL3">
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