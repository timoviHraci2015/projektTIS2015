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
	$sql = mysql_query("SELECT id_category FROM category WHERE name= 'Stopár'") or die ("ERROR SELECT CATEG: ".mysql_error());
	$categ = mysql_fetch_object($sql);
	$_SESSION['categ'] = $categ->id_category;
	//echo $_SESSION['categ'];
	
	if (isset($_GET['send'])){
		//echo "send";
		$sql = mysql_query("SELECT category_tag.id_category_tag FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
		while ($robot = mysql_fetch_object($sql)) {
			$sql2 = mysql_query("SELECT * FROM linefollower WHERE id_category_tag = ".$robot->id_category_tag) or die(mysql_error());			
			if (mysql_num_rows($sql2) == 0) { 
				//echo "INSERT <br>";
				$run_1 = "00:".$_POST['run_1'][$robot->id_category_tag];
				$run_2 = "00:".$_POST['run_2'][$robot->id_category_tag];
				$run_3 = "00:".$_POST['run_3'][$robot->id_category_tag];
				
				//pripad neplatnehu pokusu "--:--"
				if ($run_1 == "00:--:--")  { $run_1 = "00:59:59";}
				if ($run_2 == "00:--:--")  { $run_2 = "00:59:59";}
				if ($run_3 == "00:--:--")  { $run_3 = "00:59:59";}
				
				$run_best = $run_1;
				if (strtotime($run_2) < strtotime($run_best)) {
					$run_best = $run_2;
				}
				if (strtotime($run_3) < strtotime($run_best)) {
					$run_best = $run_3;
				}
				
				//$robot->id_category_tag;
				mysql_query("INSERT INTO linefollower (id_category_tag, run_1, run_2, run_3, run_best) VALUES (".$robot->id_category_tag.", '$run_1', '$run_2', '$run_3', '$run_best')") or die ("ERROR INSERT RUNs: ".mysql_error());
			
			} else {
				//echo "<br >EDIT: ".$robot->id_category_tag."    >>";
				$run_1 = "00:".$_POST['run_1'][$robot->id_category_tag];
				$run_2 = "00:".$_POST['run_2'][$robot->id_category_tag];
				$run_3 = "00:".$_POST['run_3'][$robot->id_category_tag];
				
				//pripad neplatnehu pokusu "--:--"
				if ($run_1 == "00:--:--")  { $run_1 = "00:59:59";}
				if ($run_2 == "00:--:--")  { $run_2 = "00:59:59";}
				if ($run_3 == "00:--:--")  { $run_3 = "00:59:59";}
				
				$run_best = $run_1;
				if (strtotime($run_2) < strtotime($run_best)) {
					$run_best = $run_2;
				}
				if (strtotime($run_3) < strtotime($run_best)) {
					$run_best = $run_3;
				}
				
				
				mysql_query("UPDATE linefollower SET run_1 = '$run_1', run_2 = '$run_2', run_3 = '$run_3', run_best = '$run_best' WHERE id_category_tag = ".$robot->id_category_tag) or die ("ERROR UPDATE RUNs: ".mysql_error());		
			}
			
		}
		
	}
	
	// nulovanie premennych
	$run1 = "";
	$run2 = "";
	$run3 = "";	
	
	
	//select robots pre category
	$i = 1;
	$sql = mysql_query("SELECT linefollower.run_1, linefollower.run_2, linefollower.run_3 
	FROM linefollower INNER JOIN category_tag ON linefollower.id_category_tag = category_tag.id_category_tag 
	WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die ("ERROR SELECT RUNS: ".mysql_error());
	while ($robot = mysql_fetch_object($sql)){
		$run1[$i] = substr($robot->run_1, 3);
		$run2[$i] = substr($robot->run_2, 3);
		$run3[$i] = substr($robot->run_3, 3);
		
		//pripad neplatnehu pokusu "--:--"
		if ($run1[$i] == "59:59")  { $run1[$i] = "--:--";}
		if ($run2[$i] == "59:59")  { $run2[$i] = "--:--";}
		if ($run3[$i] == "59:59")  { $run3[$i] = "--:--";}
				
		$i++;	
	}
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
				<FORM name="myform" action="list1.php?send" Method="POST">
					<TABLE class="data">
						<TR><TH class="num">č</TH><TH>Súťažiaci</TH><TH colspan = 3>Pokus / Run</TH><TH>Poznámky</TH><TH>Poradie</TH></TR>
						<TR><TD class="num">&nbsp;</TD><TH class="mutal">Robot name</TH><TH class="mutal">1<br/>[s]</TH><TH class="mutal">2<br/>[s]</TH><TH class="mutal">3<br/>[s]</TH><TH class="mutal">Remarks</TH><TH class="mutal">Order</TH></TR>
						<?php
							
							$sql = mysql_query("SELECT category_tag.id_category_tag, robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
							$i = 1;
							while ($robot = mysql_fetch_object($sql)) {
				
								echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_1[".$robot->id_category_tag."]\" Size=\"21\" value = \"".$run1[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_2[".$robot->id_category_tag."]\" Size=\"21\" value = \"".$run2[$i]."\"></TD>";
								echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_3[".$robot->id_category_tag."]\" Size=\"21\" value = \"".$run3[$i]."\"></TD>";
								echo "<TD></TD>";
								echo "<TD></TD></TR>";
								$i++;
							}
						?>
						<TR><TH colspan = "7"><INPUT Type="submit" Name="send" value="Odošli"></TH></TR>	
					</TABLE>
				</FORM>
			</div>
		</div>	
	</body>	
</html>