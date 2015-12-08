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
					<TR><TH class="num">č</TH><TH>Meno robota</TH><TH>Body spolu</TH><TH>Elektronika</TH><TH>Mechanika</TH><TH>Softvér</TH><TH>Nápad</TH><TH>Funkčnosť</TH><TH>Poster</TH><TH>Poznámky</TH></TR>
					<?php
						
						openMySQL($host, $user, $passwd, $db);
						$sql_year = mysql_query("SELECT year FROM competition_year");
						$item = mysql_fetch_object($sql_year);
						$year = $item->year;
						$sql = mysql_query("SELECT robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 4 AND category_tag.year = ".$year." ORDER BY category_tag.start_num ASC") or die(mysql_error());
						while ($robot = mysql_fetch_object($sql)) {
							echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD></TR>";
						}
					?>
					<TR>
						<TD></TD>
						<TD></TD>
						<TD></TD>
						<TD style="font-size: 10px">Zložitosť, prevedenie, nápaditosť, vlastný vklad<br/>0 – nevhodná<br/>1 – akurát<br/>2 – vhodný komerčný výrobok<br/>3 – vlastný výtvor</TD>
						<TD style="font-size: 10px">Zložitosť, prevedenie, nápaditosť, vlastný vklad<br/>0 – nevhodná<br/>1 – zo stavebnice<br/>2 – zo stavebnice + vklad<br/>3 – vlastný výtvor</TD>
						<TD style="font-size: 10px">Funkcia, komplexnosť, implementačná zložitosť<br/>0 – nefunguje<br/>1 – demo, spravil niekto iný<br/>2 – vlastný ako tak<br/>3 – vlastný výtvor</TD>
						<TD style="font-size: 10px"><br/><br/>0 – prevzatý<br/>1 – priemerný<br/>2 – zaujímavý<br/>3 – neobvyklý</TD>
						<TD style="font-size: 10px"><br/><br/>0 – nefunguje<br/>1 – niekedy<br/>2 – malé zádrhely<br/>3 – bezchybne všetko</TD>
						<TD style="font-size: 10px"><br/><br/>0 – nie je<br/>1 – len textový<br/>2 – text + obrázky<br/>3 – pridaná hodnota</TD>
						<TD></TD>
					</TR>		
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