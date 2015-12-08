<?php
	require_once("../config.php");
	require_once("../functions.php");
?>
<html>
	<head>
		<title>:: ISTROBOT 2013 - Myš v bludisku ::</title>
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
				<h3>Kategória Myš v bludisku</h3>
				Micromouse
				<br/><br/>
				<TABLE class="data">
					<TR><TH class="num">č</TH><TH class="horizontal">Súťažiaci</TH><TH colspan = 4>Pokus 1</TH><TH colspan = 4>Pokus 2</TH><TH colspan = 4>Pokus 3</TH><TH class="end">Poradie</TH></TR>
					<TR><TD class="num">&nbsp;</TD><TH class="mutal">Robot name</h3></TH><TH class="times">Čas pokusu <br/>[s]</TH><TH class="times">Čas v bludisku <br/>[s]</TH><TH class="times">Za pokuty <br/>[s]</TH><TH class="times">Súťažný čas <br/>[s]</TH>
														  <TH class="times">Run time <br/>[s]</TH><TH class="times">Maze time <br/>[s]</TH><TH class="times">Penalties <br/>[s]</TH><TH class="times">Time <br/>[s]</TH>
														  <TH class="times">Čas pokusu <br/>[s]</TH><TH class="times">Čas v bludisku <br/>[s]</TH><TH class="times">Za pokuty <br/>[s]</TH><TH class="times">Súťažný čas <br/>[s]</TH>		
					<TH class="mutal">Order</TH></TR>
					<?php
						
						openMySQL($host, $user, $passwd, $db);
						$sql_year = mysql_query("SELECT year FROM competition_year");
						$item = mysql_fetch_object($sql_year);
						$year = $item->year;
						$sql = mysql_query("SELECT robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 2 AND category_tag.year = ".$year." ORDER BY category_tag.start_num ASC") or die(mysql_error());
						while ($robot = mysql_fetch_object($sql)) {
							echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD></TR>";
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