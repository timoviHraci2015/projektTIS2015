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
				<div class="lang">
					<a href="index.php?page=news"><img src="images/sk.gif" alt="SK"></a>
					<a href="EN/index.php?page=news"><img src="images/en.gif" alt="EN"></a>	
				</div>
				<ul class="menu_list">
					<?php
						if (isset($_GET['page'])){
							//novinky
							if (($_GET['page'] == "news") || ($_GET['page'] == "stats")) {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=news\">Novinky</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=news\">Novinky</a></li>";
							}
							//pravidla
							if ($_GET['page'] == "rules") {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=rules\">Pravidlá</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=rules\">Pravidlá</a></li>";
							}
							//prihlaska
							if ($_GET['page'] == "login" || $_GET['page'] == "login2" || $_GET['page'] == "lor" || $_GET['page'] == "confirm") {
							//pre nelognuteho linkovanie na prihlasit sa! {logme}
								if ($_SESSION['a_id'] == ""){
									echo "<li><a class=\"menu_button current\" href=\"index.php?page=logme\">Prihláška</a></li>";
								} elseif (!empty($_SESSION['a_id'])) {
									echo "<li><a class=\"menu_button current\" href=\"index.php?page=login\">Môj profil</a></li>";
								}		
							} else {
							//pre nelognuteho linkovanie na prihlasit sa! {logme}
								if ($_SESSION['a_id'] == ""){
									echo "<li><a class=\"menu_button\" href=\"index.php?page=logme\">Prihláška</a></li>";
								} elseif (!empty($_SESSION['a_id'])) {
									echo "<li><a class=\"menu_button\" href=\"index.php?page=login\">Môj profil</a></li>";
								}	
							}
							//roboty
							if ($_GET['page'] == "robots") {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=robots\">Roboty</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=robots\">Roboty</a></li>";
							}
							// results
							if ($_GET['page'] == "results") {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=results\">Výsledky</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=results\">Výsledky</a></li>";
							}
							//poradna
							if ($_GET['page'] == "advice") {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=advice\">Poradňa</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=advice\">Poradňa</a></li>";
							}
							//archiv
							if ($_GET['page'] == "archive") {
								echo "<li><a class=\"menu_button current\" href=\"index.php?page=archive\">Archív</a></li>";
							} else {
								echo "<li><a class=\"menu_button\" href=\"index.php?page=archive\">Archív</a></li>";
							}
							//prihlas ma
							if ($_GET['page'] == "logme") {
								if (!empty($_SESSION['a_id'])) {
									echo "<li><a class=\"menu_button current\" href=\"index.php?page=logout\">Odhlásiť sa</a></li>";
								} elseif ($_SESSION['a_id'] == "") {
									echo "<li><a class=\"menu_button current\" href=\"index.php?page=logme\">Prihlásiť sa</a></li>";
								}	
							} else {
								if (!empty($_SESSION['a_id'])) {
									echo "<li><a class=\"menu_button\" href=\"index.php?page=logout\">Odhlásiť sa</a></li>";
								} elseif ($_SESSION['a_id'] == "") {
									echo "<li><a class=\"menu_button\" href=\"index.php?page=logme\">Prihlásiť sa</a></li>";
								}
							}	
						} else {
							echo "<li><a class=\"menu_button current\" href=\"index.php?page=news\">Novinky</a></li>";
							echo "<li><a class=\"menu_button\" href=\"index.php?page=rules\">Pravidlá</a></li>";
							echo "<li><a class=\"menu_button\" href=\"index.php?page=logme\">Prihláška</a></li>";
							echo "<li><a class=\"menu_button\" href=\"index.php?page=robots\">Roboty</a></li>";
							echo "<li><a class=\"menu_button\" href=\"index.php?page=advice\">Poradňa</a></li>";
							echo "<li><a class=\"menu_button\" href=\"index.php?page=archive\">Archív</a></li>";
							echo "<li><a class=\"menu_button\" href=\"index.php?page=logme\">Prihlásiť sa</a></li>";
						}
					?>
				</ul>		
			</div>
			<div class="advert">
				<p>
				<A HREF="http://www.facebook.com/Istrobot" Target="_blank" Title="Join Us on Facebook!"><IMG Src="images/logoFacebook.png" Width=122 Height=62 Border=0 Alt="Like Us on Facebook!"></A><BR>
                <br>
				<p><b>Organizátori</b></p>
				<A HREF="http://www.urpi.fei.stuba.sk/index.php?lang=en" Target="_blank" Title="URPI FEI STU"><IMG Src="images/logoURPI.png" Width=150 Height=69 Border=0 Alt="URPI FEI STU"></A><BR>
				<A HREF="http://www.fei.stuba.sk/generate_page.php?page_id=1897" Target="_blank" Title="FEI STU"><IMG Src="images/logoFEI.png" Width=150 Height=61 Border=0 Alt="FEI STU"></A><BR>
				</br>
				<A HREF="http://www.robotics.sk/" Target="_blank" Title="Robotika.SK"><IMG Src="images/logoRobotika3.png" Width=150 Height=32 Border=0 Alt="Robotika.SK"></A><BR>
				</br>
				<p><b>Sponzori</b></p>
				</br>
			        <A HREF="http://www.aerobtec.com/" Target="_blank" Title="AerobTec"><IMG Src="images/logoAerobTec.png" Width=170 Height=32 Border=0 Alt="AerobTec"></A>
				</br>
                                <A HREF="http://www.alef.com/" Target="_blank" Title="Alef"><IMG Src="images/logoALEF.png" Width=150  Border=0 Alt="ALEF"></A>
				</br>
                                <A HREF="http://www.avir.sk/" Target="_blank" Title="Avir"><IMG Src="images/logoAVIR.png" Width=150  Border=0 Alt="AVIR"></A>
				</br>
                                <A HREF="http://www.microrisc.cz/" Target="_blank" Title="Microrisc"><IMG Src="images/logoMicrorisc.png" Width=140 Height=110 Border=0 Alt="MicroRisc"></A>
				</br>
				<A HREF="http://www.freescale.cz/" Target="_blank" Title="Freescale"><IMG Src="images/logoFreescale.png" Width=150 Border=0 Alt="Freescale"></A><BR>
				</br>
				<A HREF="http://www.microstep.eu/" Target="_blank" Title="MicroStep"><IMG Src="images/logoMicroStep.png" Width=150 Border=0 Alt="MicroStep"></A>
				</br>
				<A HREF="http://www.me-inspection.sk/" Target="_blank" Title="ME-Inspection SK"><IMG Src="images/logoMEinspection.png" Width=150 Height=66 Border=0 Alt="ME-Inspection SK"></A><BR>
				</br>
				<A HREF="http://www.microstep-mis.sk/" Target="_blank" Title="MicroStep-MIS"><IMG Src="images/logoMicrosStepMIS.png" Width=150  Border=0 Alt="MicroStep-MIS"></A><BR>
				</br>
				<A HREF="http://www.rlx.sk/" Target="_blank" Title="RLX"><IMG Src="images/logoRLX.png" Width=150  Border=0 Alt="RLX"></A><BR>
				<A HREF="http://www.rlx.sk/" Target="_blank" Title="RLX">www.rlx.sk</A>
				</br>
				</br>
				<p><b>Mediálni partneri</b></p>
				
				<A HREF="http://www.quark.sk/" Target="_blank" Title="Quark"><IMG Src="images/logoQuark.png" Width=150 Height=59 Border=0 Alt="Quark"></A>
				</br>
				<A HREF="http://www.equark.sk/" Target="_blank" Title="eQuark"><IMG Src="images/logoeQuark.png" Width=150 Height=86 Border=0 Alt="Quark"></A>
				</br>
				<A HREF="http://oko.fei.sk/" Target="_blank" Title="OKO"><IMG Src="images/logoOKO.png" Width=150 Height=35 Border=0 Alt="OKO"></A>
				</br>
				<A HREF="http://www.mc2.sk/" Target="_blank" Title="MC2"><IMG Src="images/logoMC2.png" Width=150 Height=71 Border=0 Alt="mc2"></A>
				</br>
				<A HREF="http://www.casopisee.sk/" Target="_blank" Title="EE"><IMG Src="images/logoEE.png" Width=100 Height=100 Border=0 Alt=" EE "></A>
			</div>