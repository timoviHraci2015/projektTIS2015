<?php
	session_start();
	header('Cache-control: private');

	//set na dany rok sutaze - bude sa menit!
	openMySQL($host, $user, $passwd, $db);
	$sql = mysql_query("select year from competition_year where id_cyear = 1") or die ("ERROR: ".mysql_error());
	$competition = mysql_fetch_object($sql);
	$_SESSION['year'] = $competition->year; 
?>
<!doctype html>
<html>
<head>
	<title>:: ISTROBOT 2013 ::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="Robot, robotika, Istrobot" />	
	<meta name="description" content="Istrobot robotics competition" />
	<meta name="author" content="Copyright © 2012 robotika.sk, All Rights Reserved." />
	<link Rel=StyleSheet href="istrobot.css" type="text/css">
	<!-- Autocomplete JQuery -->
	<script src="js/jquery-1.8.2.min.js"></script>
	<link rel="stylesheet" href="js/jquery.autocomplete.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
	<script>
		$(document).ready(function(){
			//var data = "AndraPradesh ArunachalPradesh Assam Bihar Chhattisgarh Goa Gujarat Haryana HimachalPradesh Jammuan&Kashmir Jharkhand Karnataka Kerala MadyaPradesh Maharashtra Manipur Meghalaya Mizoram Nagaland Orissa Punjab Rajasthan Sikkim Tamil Nadu Tripura Uttaranchal UttarPradesh WestBengal".split(" ");
			<?php
				$data = "Brezovica";
				openMySQL($host, $user, $passwd, $db);
				$sql = mysql_query("SELECT town_name from town_reducted");
				while ($town = mysql_fetch_object($sql)) {
					$data = $data."_".$town->town_name;
				}
			echo "var town = \"".$data."\".split(\"_\");";
			?>
			//alert(data);
			$("#town").autocomplete(town);
		});
	</script>
	<!--END Autocomplete JQuery -->
</head>

<body>
	<div class="body_bg">
			<div class="menu">
				<ul class="menu_list">
					<?php
						if (!empty($_SESSION['sudo'])){
							//admini
							if ($_GET['page'] == "admin") {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=admin\">Admini</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=admin\">Admini</a></li>";
							}
							//uzivatelia
							if (($_GET['page'] == "users") || ($_GET['page'] == "user")) {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=users\">Užívatelia</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=users\">Užívatelia</a></li>";
							}
							//roboty
							if (($_GET['page'] == "robots") || ($_GET['page'] == "robot")) {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=robots\">Roboty</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=robots\">Roboty</a></li>";
							}
							//uzavierka registracie + instalacia noeveho rocnika sutaze
							if ($_GET['page'] == "setup" ) {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=setup\">Súťaž</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=setup\">Súťaž</a></li>";
							}
							//vysledky
							if ($_GET['page'] == "stats") {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=stats\">Výsledky</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=stats\">Výsledky</a></li>";
							}	
							//odhlasit sa
							echo "<li><a class=\"menu_button\" href=\"index.php?page=logout\">Odhlásiť sa</a></li>";
							
						} else {
							echo "<li><a class=\"menu_button current\" href=\"index.php?page=logme\">Prihlásiť sa</a></li>";	
						}
					?>
				</ul>
			</div>	