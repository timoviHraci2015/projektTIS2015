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
	$sql = mysql_query("SELECT id_category FROM category WHERE name= 'Myš v bludisku'") or die ("ERROR SELECT CATEG: ".mysql_error());
	$categ = mysql_fetch_object($sql);
	$_SESSION['categ'] = $categ->id_category;
	//echo $_SESSION['categ'];
	
	if (isset($_GET['send'])){
		//echo "send";
		$sql = mysql_query("SELECT category_tag.id_category_tag FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
		while ($robot = mysql_fetch_object($sql)) {
			$sql2 = mysql_query("SELECT * FROM umouse WHERE id_category_tag = ".$robot->id_category_tag) or die(mysql_error());			
			if (mysql_num_rows($sql2) == 0) { 
				///////////////echo "INSERT <br>";
				$run1_cp = "00:".$_POST['run_1_cp'][$robot->id_category_tag];
				$run1_cb = "00:".$_POST['run_1_cb'][$robot->id_category_tag];
				$run1_zp = "00:".$_POST['run_1_zp'][$robot->id_category_tag];
				$run1_sc = "00:".$_POST['run_1_sc'][$robot->id_category_tag];
				
				$run2_cp = "00:".$_POST['run_2_cp'][$robot->id_category_tag];
				$run2_cb = "00:".$_POST['run_2_cb'][$robot->id_category_tag];
				$run2_zp = "00:".$_POST['run_2_zp'][$robot->id_category_tag];
				$run2_sc = "00:".$_POST['run_2_sc'][$robot->id_category_tag];
				
				$run3_cp = "00:".$_POST['run_3_cp'][$robot->id_category_tag];
				$run3_cb = "00:".$_POST['run_3_cb'][$robot->id_category_tag];
				$run3_zp = "00:".$_POST['run_3_zp'][$robot->id_category_tag];
				$run3_sc = "00:".$_POST['run_3_sc'][$robot->id_category_tag];
				
				//pripad neplatnehu pokusu "--:--"
				if ($run1_cp == "00:--:--")  { $run1_cp = "00:59:59";}
				if ($run1_cb == "00:--:--")  { $run1_cb = "00:59:59";}
				if ($run1_zp == "00:--:--")  { $run1_zp = "00:59:59";}
				if ($run1_sc == "00:--:--")  { $run1_sc = "00:59:59";}
				
				if ($run2_cp == "00:--:--")  { $run2_cp = "00:59:59";}
				if ($run2_cb == "00:--:--")  { $run2_cb = "00:59:59";}
				if ($run2_zp == "00:--:--")  { $run2_zp = "00:59:59";}
				if ($run2_sc == "00:--:--")  { $run2_sc = "00:59:59";}
				
				if ($run3_cp == "00:--:--")  { $run3_cp = "00:59:59";}
				if ($run3_cb == "00:--:--")  { $run3_cb = "00:59:59";}
				if ($run3_zp == "00:--:--")  { $run3_zp = "00:59:59";}
				if ($run3_sc == "00:--:--")  { $run3_sc = "00:59:59";}
				
				$run_best_sc = $run1_sc;
				if (strtotime($run2_sc) < strtotime($run_best_sc)) {
					$run_best_sc = $run2_sc;
				}
				if (strtotime($run3_sc) < strtotime($run_best_sc)) {
					$run_best_sc = $run3_sc;
				}
				
				mysql_query("INSERT INTO umouse (id_category_tag, run_1_cp, run_1_cb, run_1_zp, run_1_sc,
				run_2_cp, run_2_cb, run_2_zp, run_2_sc, run_3_cp, run_3_cb, run_3_zp, run_3_sc, run_best_sc) 
				VALUES (".$robot->id_category_tag.", '$run1_cp', '$run1_cb', '$run1_zp', '$run1_sc', '$run2_cp', '$run2_cb', '$run2_zp', '$run2_sc',
				'$run3_cp', '$run3_cb', '$run3_zp', '$run3_sc', '$run_best_sc')") or die ("ERROR INSERT RUNs: ".mysql_error());
			
			} else {
				//echo "EDIT <br>";
				$run1_cp = "00:".$_POST['run_1_cp'][$robot->id_category_tag];
				$run1_cb = "00:".$_POST['run_1_cb'][$robot->id_category_tag];
				$run1_zp = "00:".$_POST['run_1_zp'][$robot->id_category_tag];
				$run1_sc = "00:".$_POST['run_1_sc'][$robot->id_category_tag];
				
				$run2_cp = "00:".$_POST['run_2_cp'][$robot->id_category_tag];
				$run2_cb = "00:".$_POST['run_2_cb'][$robot->id_category_tag];
				$run2_zp = "00:".$_POST['run_2_zp'][$robot->id_category_tag];
				$run2_sc = "00:".$_POST['run_2_sc'][$robot->id_category_tag];
				
				$run3_cp = "00:".$_POST['run_3_cp'][$robot->id_category_tag];
				$run3_cb = "00:".$_POST['run_3_cb'][$robot->id_category_tag];
				$run3_zp = "00:".$_POST['run_3_zp'][$robot->id_category_tag];
				$run3_sc = "00:".$_POST['run_3_sc'][$robot->id_category_tag];
				
				//pripad neplatnehu pokusu "--:--"
				if ($run1_cp == "00:--:--")  { $run1_cp = "00:59:59";}
				if ($run1_cb == "00:--:--")  { $run1_cb = "00:59:59";}
				if ($run1_zp == "00:--:--")  { $run1_zp = "00:59:59";}
				if ($run1_sc == "00:--:--")  { $run1_sc = "00:59:59";}
				
				if ($run2_cp == "00:--:--")  { $run2_cp = "00:59:59";}
				if ($run2_cb == "00:--:--")  { $run2_cb = "00:59:59";}
				if ($run2_zp == "00:--:--")  { $run2_zp = "00:59:59";}
				if ($run2_sc == "00:--:--")  { $run2_sc = "00:59:59";}
				
				if ($run3_cp == "00:--:--")  { $run3_cp = "00:59:59";}
				if ($run3_cb == "00:--:--")  { $run3_cb = "00:59:59";}
				if ($run3_zp == "00:--:--")  { $run3_zp = "00:59:59";}
				if ($run3_sc == "00:--:--")  { $run3_sc = "00:59:59";}
				
				$run_best_sc = $run1_sc;
				if (strtotime($run2_sc) < strtotime($run_best_sc)) {
					$run_best_sc = $run2_sc;
				}
				if (strtotime($run3_sc) < strtotime($run_best_sc)) {
					$run_best_sc = $run3_sc;
				}
							
				$robot->id_category_tag;
				mysql_query("UPDATE umouse SET run_1_cp = '$run1_cp', run_1_cb = '$run1_cb', run_1_zp = '$run1_zp', run_1_sc = '$run1_sc', 
				run_2_cp = '$run2_cp', run_2_cb = '$run2_cb', run_2_zp = '$run2_zp', run_2_sc = '$run2_sc',
				run_3_cp = '$run3_cp', run_3_cb = '$run3_cb', run_3_zp = '$run3_zp', run_3_sc = '$run3_sc', 
				run_best_sc = '$run_best_sc' WHERE id_category_tag = ".$robot->id_category_tag) or die ("ERROR UPDATE RUNs: ".mysql_error());		
			}
			
		}
		
	}
	
	// nulovanie premennych
		$run1_cp = "";
		$run1_cb = "";
		$run1_zp = "";
		$run1_sc = "";
		
		$run2_cp = "";
		$run2_cb = "";
		$run2_zp = "";
		$run2_sc = "";
		
		$run3_cp = "";
		$run3_cb = "";
		$run3_zp = "";
		$run3_sc = "";
	
	
	//select robots pre category
	$i = 1;
	$sql = mysql_query("SELECT umouse.* 
	FROM umouse INNER JOIN category_tag ON umouse.id_category_tag = category_tag.id_category_tag 
	WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die ("ERROR SELECT RUNS: ".mysql_error());
	while ($robot = mysql_fetch_object($sql)){
		$run1_cp[$i] = substr($robot->run_1_cp, 3);
		$run1_cb[$i] = substr($robot->run_1_cb, 3);
		$run1_zp[$i] = substr($robot->run_1_zp, 3);
		$run1_sc[$i] = substr($robot->run_1_sc, 3);
		
		$run2_cp[$i] = substr($robot->run_2_cp, 3);
		$run2_cb[$i] = substr($robot->run_2_cb, 3);
		$run2_zp[$i] = substr($robot->run_2_zp, 3);
		$run2_sc[$i] = substr($robot->run_2_sc, 3);
		
		$run3_cp[$i] = substr($robot->run_3_cp, 3);
		$run3_cb[$i] = substr($robot->run_3_cb, 3);
		$run3_zp[$i] = substr($robot->run_3_zp, 3);
		$run3_sc[$i] = substr($robot->run_3_sc, 3);
		
		//pripad neplatnehu pokusu "--:--"
		if ($run1_cp[$i] == "59:59")  { $run1_cp[$i] = "--:--";}
		if ($run1_cb[$i] == "59:59")  { $run1_cb[$i] = "--:--";}
		if ($run1_zp[$i] == "59:59")  { $run1_zp[$i] = "--:--";}
		if ($run1_sc[$i] == "59:59")  { $run1_sc[$i] = "--:--";}
		
		if ($run2_cp[$i] == "59:59")  { $run2_cp[$i] = "--:--";}
		if ($run2_cb[$i] == "59:59")  { $run2_cb[$i] = "--:--";}
		if ($run2_zp[$i] == "59:59")  { $run2_zp[$i] = "--:--";}
		if ($run2_sc[$i] == "59:59")  { $run2_sc[$i] = "--:--";}
		
		if ($run3_cp[$i] == "59:59")  { $run3_cp[$i] = "--:--";}
		if ($run3_cb[$i] == "59:59")  { $run3_cb[$i] = "--:--";}
		if ($run3_zp[$i] == "59:59")  { $run3_zp[$i] = "--:--";}
		if ($run3_sc[$i] == "59:59")  { $run3_sc[$i] = "--:--";}
			
		$i++;	
	}
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
				<FORM name="myform" action="list2.php?send" Method="POST">
					<TABLE class="data">
						<TR><TH class="num">č</TH><TH class="horizontal">Súťažiaci</TH><TH colspan = 4>Pokus 1</TH><TH colspan = 4>Pokus 2</TH><TH colspan = 4>Pokus 3</TH><TH class="end">Poradie</TH></TR>
						<TR><TD class="num">&nbsp;</TD><TH class="mutal">Robot name</h3></TH><TH class="times">Čas pokusu <br/>[s]</TH><TH class="times">Čas v bludisku <br/>[s]</TH><TH class="times">Za pokuty <br/>[s]</TH><TH class="times">Súťažný čas <br/>[s]</TH>
														<TH class="times">Run time <br/>[s]</TH><TH class="times">Maze time <br/>[s]</TH><TH class="times">Penalties <br/>[s]</TH><TH class="times">Time <br/>[s]</TH>
														<TH class="times">Čas pokusu <br/>[s]</TH><TH class="times">Čas v bludisku <br/>[s]</TH><TH class="times">Za pokuty <br/>[s]</TH><TH class="times">Súťažný čas <br/>[s]</TH>		
														<TH class="mutal">Order</TH></TR>
							<?php
								
								$sql = mysql_query("SELECT category_tag.id_category_tag, robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
								$i = 1;
								while ($robot = mysql_fetch_object($sql)) {
					
									echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_1_cp[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run1_cp[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_1_cb[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run1_cb[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_1_zp[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run1_zp[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_1_sc[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run1_sc[$i]."\"></TD>";
									
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_2_cp[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run2_cp[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_2_cb[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run2_cb[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_2_zp[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run2_zp[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_2_sc[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run2_sc[$i]."\"></TD>";
									
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_3_cp[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run3_cp[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_3_cb[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run3_cb[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_3_zp[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run3_zp[$i]."\"></TD>";
									echo "<TD style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"run_3_sc[".$robot->id_category_tag."]\" Size=\"2\" value = \"".$run3_sc[$i]."\"></TD>";
									
									echo "<TD></TD></TR>";
									$i++;
								}
							?>
							<TR><TH colspan = "15"><INPUT Type="submit" Name="send" value="Odošli"></TH></TR>
					</TABLE>
				</FORM>	
			</div>
		</div>	
	</body>	
</html>