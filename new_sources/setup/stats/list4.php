<?php
	require_once("../config.php");
	require_once("../functions.php");
	
	//set na dany rok sutaze - bude sa menit!
	openMySQL($host, $user, $passwd, $db);
	$sql = mysql_query("SELECT year FROM competition_year WHERE id_cyear = 1") or die ("ERROR SELECT YEAR: ".mysql_error());
	$competition = mysql_fetch_object($sql);
	$_SESSION['year'] = $competition->year;
	//echo $_SESSION['year'];
	
	//select id pre category
	$sql = mysql_query("SELECT id_category FROM category WHERE name= 'Voľná jazda'") or die ("ERROR SELECT CATEG: ".mysql_error());
	$categ = mysql_fetch_object($sql);
	$_SESSION['categ'] = $categ->id_category;
	//echo $_SESSION['categ'];
	
	if (isset($_GET['send'])){
		//echo "send";
		$sql = mysql_query("SELECT category_tag.id_category_tag FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
		while ($robot = mysql_fetch_object($sql)) {
			$sql2 = mysql_query("SELECT * FROM freestyle WHERE id_category_tag = ".$robot->id_category_tag) or die(mysql_error());			
			if (mysql_num_rows($sql2) == 0) { 
				
				//echo "INSERT <br>";
				if (!empty($_POST['electronics'][$robot->id_category_tag])){
					$electronic = $_POST['electronics'][$robot->id_category_tag];
				} else {
					$electronic = 0;
				}

				if (!empty($_POST['mechanics'][$robot->id_category_tag])){	
					$mechanic = $_POST['mechanics'][$robot->id_category_tag];
				} else {
					$mechanic = 0;
				}

				if (!empty($_POST['software'][$robot->id_category_tag])){		
					$softwar = $_POST['software'][$robot->id_category_tag];
				} else {
					$softwar =0;
				}
				
				if (!empty($_POST['idea'][$robot->id_category_tag])){		
					$ide = $_POST['idea'][$robot->id_category_tag];
				} else {
					$ide = 0;
				}
				
				if (!empty($_POST['fcity'][$robot->id_category_tag])){	
					$fcit = $_POST['fcity'][$robot->id_category_tag];
				} else {
					$fcit = 0;
				}
				
				if (!empty($_POST['poster'][$robot->id_category_tag])){
					$poste = $_POST['poster'][$robot->id_category_tag];
				} else {
					$poste = 0;
				}	
				
				if (!empty($_POST['total'][$robot->id_category_tag])){
					$tota = $_POST['total'][$robot->id_category_tag];
				} else {
					$tota = 0;
				}			

				mysql_query("INSERT INTO freestyle (id_category_tag, electronics, mechanics, software, idea, fcity, poster, total) VALUES (".$robot->id_category_tag.", '$electronic', '$mechanic', '$softwar', '$ide', '$fcit', '$poste', '$tota')") or die ("ERROR INSERT DATA: ".mysql_error());
			
			} else {
				//echo "<br >EDIT: ";
				if (!empty($_POST['electronics'][$robot->id_category_tag])){
					$electronic = $_POST['electronics'][$robot->id_category_tag];
				} else {
					$electronic = 0;
				}

				if (!empty($_POST['mechanics'][$robot->id_category_tag])){	
					$mechanic = $_POST['mechanics'][$robot->id_category_tag];
				} else {
					$mechanic = 0;
				}

				if (!empty($_POST['software'][$robot->id_category_tag])){		
					$softwar = $_POST['software'][$robot->id_category_tag];
				} else {
					$softwar =0;
				}
				
				if (!empty($_POST['idea'][$robot->id_category_tag])){		
					$ide = $_POST['idea'][$robot->id_category_tag];
				} else {
					$ide = 0;
				}
				
				if (!empty($_POST['fcity'][$robot->id_category_tag])){	
					$fcit = $_POST['fcity'][$robot->id_category_tag];
				} else {
					$fcit = 0;
				}
				
				if (!empty($_POST['poster'][$robot->id_category_tag])){
					$poste = $_POST['poster'][$robot->id_category_tag];
				} else {
					$poste = 0;
				}	
				
				if (!empty($_POST['total'][$robot->id_category_tag])){
					$tota = $_POST['total'][$robot->id_category_tag];
				} else {
					$tota = 0;
				}	
				
				mysql_query("UPDATE freestyle SET electronics = '$electronic', mechanics = '$mechanic', software = '$softwar', idea = '$ide', fcity = '$fcit', poster = '$poste', total = '$tota' WHERE id_category_tag = ".$robot->id_category_tag) or die ("ERROR UPDATE DATA: ".mysql_error());		
			}
			
		}
		
	}
	
	//select robots for category
	$i = 1;
	$sql = mysql_query("SELECT freestyle.*
	FROM freestyle INNER JOIN category_tag ON freestyle.id_category_tag = category_tag.id_category_tag 
	WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die ("ERROR SELECT DATA: ".mysql_error());
	while ($robot = mysql_fetch_object($sql)){
		$electronics[$i] = $robot->electronics;
		$mechanics[$i] = $robot->mechanics;
		$software[$i] = $robot->software;
		$idea[$i] = $robot->idea;
		$fcity[$i] = $robot->fcity;
		$poster[$i] = $robot->poster;
		$total[$i] = $robot->total;		
		$i++;	
	}
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
				<FORM name="myform" action="list4.php?send" Method="POST">
					<TABLE class="data">
						<TR><TH class="num">č</TH><TH>Meno robota</TH><TH>Body spolu</TH><TH>Elektronika</TH><TH>Mechanika</TH><TH>Softvér</TH><TH>Nápad</TH><TH>Funkčnosť</TH><TH>Poster</TH><TH>Poznámky</TH></TR>
						<?php
							
							$sql = mysql_query("SELECT robot.name, category_tag.id_category_tag, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 4 AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
							$i = 1;
							while ($robot = mysql_fetch_object($sql)) {
								echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH>";
								
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"total[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$total[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"electronics[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$electronics[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"mechanics[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$mechanics[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"software[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$software[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"idea[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$idea[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"fcity[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$fcity[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"poster[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$poster[$i]."\"></TD>";
								
								echo "<TD></TD></TR>";
								$i++;
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
						<TR><TH colspan = "10"><INPUT Type="submit" Name="send" value="Odošli"></TH></TR>		
					</TABLE>
				</FORM>	
			</div>
		</div>	
	</body>	
</html>