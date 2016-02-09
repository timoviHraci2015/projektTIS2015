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
	$sql = mysql_query("SELECT id_category FROM category WHERE name= 'Sklad kečupov'") or die ("ERROR SELECT CATEG: ".mysql_error());
	$categ = mysql_fetch_object($sql);
	$_SESSION['categ'] = $categ->id_category;
	//echo $_SESSION['categ'];
	
	if (isset($_GET['send'])){
		//echo "send";
		
		//set array of id_category_tag
		$sql = mysql_query("SELECT category_tag.id_category_tag FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
		$l = 0;
		while ($robot = mysql_fetch_object($sql)) {
			$opnt_id[$l] = $robot->id_category_tag;
			$l++;
		}
		$sql = mysql_query("SELECT category_tag.id_category_tag FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = ".$_SESSION['categ']." AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
		while ($robot = mysql_fetch_object($sql)) {
			foreach ($opnt_id as $oponent) {

				$sql2 = mysql_query("SELECT * FROM ketchup WHERE id_category_tag = ".$robot->id_category_tag." AND id_category_tag_opnt = ".$oponent) or die("LOL".mysql_error());	
				if (mysql_num_rows($sql2) == 0) { 
					
					if (!empty($_POST[$robot->id_category_tag][$oponent])){
						$rank = $_POST[$robot->id_category_tag][$oponent];
					} else {
						$rank = 0;
					}	
					
					if ($robot->id_category_tag != $oponent) {
						mysql_query("INSERT INTO ketchup (id_category_tag, `rank`, id_category_tag_opnt) VALUES (".$robot->id_category_tag.", ".$rank.", ".$oponent.")") 
						or die ("ERROR INSERT RANKs: ".mysql_error());
					}	
				
				} else {
					//echo "<br >EDIT";
					
					if (!empty($_POST[$robot->id_category_tag][$oponent])){
						$rank = $_POST[$robot->id_category_tag][$oponent];
					} else {
						$rank = 0;
					}			
					
					if ($robot->id_category_tag != $oponent) {
						mysql_query("UPDATE ketchup SET rank = $rank WHERE id_category_tag = ".$robot->id_category_tag." AND id_category_tag_opnt = ".$oponent) 
						or die ("ERROR UPDATE RANKs: ".mysql_error());		
					}
				}
			}
		}
		
	}
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
				<FORM name="myform" action="list3.php?send" Method="POST">
					<TABLE class="list3">
						<?php
							$sql = mysql_query("SELECT robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 3 AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
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
							$sql2 = mysql_query("SELECT robot.name, category_tag.id_category_tag, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 3 AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());
							$poc = mysql_num_rows($sql);
							$i = 1;
							
							//set array of id_category_tag
							$l = 0;
							while ($robot = mysql_fetch_object($sql2)) {
								$opnt_id[$l] = $robot->id_category_tag;
								$l++;
							}
							
							$sql2 = mysql_query("SELECT robot.name, category_tag.id_category_tag, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE category_tag.id_category = 3 AND category_tag.year = ".$_SESSION['year']." ORDER BY category_tag.start_num ASC") or die(mysql_error());		
							while ($robot = mysql_fetch_object($sql2)) {
								echo "<TR><TD class=\"num\">#".$robot->start_num."</TD><TH class=\"horizontal\">".$robot->name."</TH>";
								$l = 0;
								for ($k = 1; $k <= $poc; $k++) {
									if ($k == $i){
										echo "<TD class=\"shadow\"></TD>";
									} else {
										$sql3 = mysql_query("SELECT rank FROM ketchup WHERE id_category_tag = ".$robot->id_category_tag." AND id_category_tag_opnt = ".$opnt_id[$l]) or die(mysql_error());
										if ($data = mysql_fetch_object($sql3)){
											$rank = $data->rank;
										} else {
											$rank = "";
										}		
										echo "<TD class=\"num\" style = \"text-align: center\"><INPUT Type=\"text\" display=\"inline\" Name=\"".$robot->id_category_tag."[".$opnt_id[$l]."]\" Size=\"1\"  value = \"".$rank."\"></TD>";
									}
									$l++;	
								}
								$i++;
							}
							echo "</TR>";
						?>
						<TR><TH colspan = "<?php echo $poc+2; ?>"><INPUT Type="submit" Name="send" value="Odošli"></TH></TR>
					</TABLE>
				</FORM>	
			</div>
		</div>	
	</body>	
</html>