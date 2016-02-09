<?php

class FormsController{

	public function addUser(){

		if(isset($_POST["addUser"])){
			$this->checkPost(NULL);
		}

		$html  =	"<form method='post' onsubmit='return checkForm(this)'>";
		$html .= 	"<tr>";
		$html .=		"<th>Meno</th>";
		$html .=		"<td><div class='ui input'><input type='text' name = 'name' required></div></td>";
		$html .=		"<th>Vek</th>";
		$html .=		"<td><div class='ui input'><input type='number' name = 'age' ></div></td>";
		$html .=		"<th>Práca</th>";
		$html .=		"<td><div class='ui input'><input type='text' name = 'job' required></div></td>";
		$html .=	"</tr>";


		$html .= 	"<tr>";
		$html .=		"<th>Email</th>";
		$html .=		"<td><div class='ui input'><input type='email' name = 'email' required></div></td>";
		$html .=		"<th>Štát</th>";
		$html .=		"<td><div class='ui input'><input type='text' name = 'country' value = 'SR' required></div></td>";
		$html .=		"<th>Mesto</th>";
		$html .=		"<td><div class='ui input'><input type='text' name = 'city' required></div></td>";
		$html .=	"</tr>";

		$html .= 	"<tr>";
		$html .=		"<th>Adresa</th>";
		$html .=		"<td><div class='ui input'><input type='text' name = 'address' required></div></td>";
		$html .=		"<th>Heslo</th>";
		$html .=		"<td><div class='ui input'><input type='password' name = 'password' required></div></td>";
		$html .=		"<th>Overenie hesla</th>";
		$html .=		"<td><div class='ui input'><input type='password' name = 'password_varification' required></div></td>";
		$html .=	"</tr>";

		$html .= 	"<tr>";
		$html .=			"<td><input type='submit' value = 'Pridaj' name='addUser' class='positive ui button'></td>";
		$html .=	"</tr>";

		/*$html .="<table>";*/

		$html .=		"</form>";
		echo $html;
	}

	public function addCompetition(){

		if(isset($_POST["addCompetition"])){
			$this->checkPost(NULL);
		}

		//	$html  = "<table style='width:100%'>";
		$html .=	"<form method='post' onsubmit='return checkForm(this)'>";
		$html .= 	"<tr>";
		$html .=		"<th>Názov súťaže</th>";
		$html .=		"<td align='CENTER'><div class='ui input'><input type='text' name = 'name' required></div></td>";
		$html .=		"<th>Deadline prihlasovania</th>";
		$html .=		"<td align='CENTER'><div class='ui input'><input type='datetime-local' name = 'deadline' required ></div></td>";


		$html .=	"</tr>";

		$html .= 	"<tr>";
		$html .=		"<th>Počet pokusov</th>";
		$html .=			"<td align='CENTER'>";
		$html .=				"<select class='' name='measure_count' required>";
		for ($i = 0; $i<11; $i++){
			$html .= 				"<option value='".$i."'>".$i."</option>";
		}
		$html .=				"</select>";
		$html .= 			"</td>";
		$html .=		"<th>Typ súťaže</th>";
		$html .=			"<td align='CENTER'>";
		$html .=				"<select name = 'competition_type' required class=''>";
		$html .=					"<option value='1'>Časová</option>";
		$html .=					"<option value='2'>Bodová</option>";
		$html .=					"<option value='3'>Vlastná</option>";
		$html .=				"</select>";
		$html .= 			"</td>";
		$html .=	"</tr>";


		$html .=	"<tr>";
		$html .=			"<td align='CENTER'><div class='ui input'><input type='submit' value = 'Pridaj'  class='positive ui button' name='addCompetition'></div></td>";
		$html .=	"</tr>";

		$html .=		"</form>";
		//	$html .="<table>";

		echo $html;
	}

	public function addScore($competition_id){

		switch($this->getTypeOfCompetition($competition_id)){
			case 1: echo $this->getFormForAddScoreToTimeCompetitionType($competition_id); return;
			case 2: echo $this->getFormForAddScoreToPointCompetitionType($competition_id); return;
			case 3: echo $this->getFormForAddScoreToSpecialCompetitionType($competition_id); return;
			case 4: echo $this->getFormForAddScoreToPointCompetitionType($competition_id); return;
		}
		unset($_POST);

	}
	public function getResults($competition_id)
	{
		require_once("CompetitionYear.php");
		require_once("functions.php");

		$year = CompetitionYear::getCurrentYear();
		switch($this->getTypeOfCompetition($competition_id,$year)){
			case 1: echo $this->getTimeResults($competition_id,$year); return;
			case 2: echo $this->getPointResults($competition_id,$year); return;
			case 3: echo $this->getSpecialResults($competition_id,$year); return;
			case 4: echo $this->getPointResults($competition_id,$year); return;
		}
	}
	public function getTimeResults($competition_id,$year)
	{
		if ($link = spoj_s_db()) {
			$sql = "SELECT robot.name, robot.subauthor, auth.name_surname, time . * FROM  `time_competition` time JOIN  `robot` robot ON time.id_robot = robot.id_robot JOIN  `author` auth ON robot.id_author = auth.id_author JOIN  `competitions` comp ON comp.id = time.id_competition WHERE comp.id = ".$competition_id;
			$result = mysql_query($sql, $link);

			echo "<thead><tr>";

				echo "<th>Názov robota</th>";
				echo "<th>Meno autora</th>";
				echo "<th>Spoluautor</th>";
				echo "<th>Úroveň</th>";
				for($i = 1; $i < $this->getMeasureCount($competition_id)+1; $i++){
					echo "<th>Kolo ".$i."</th>";
				}
				echo "</tr></thead>";
			while ($row = mysql_fetch_assoc($result)) {
				
				echo "<tr>";

				echo "<td>".$row["name"]."</td>";
				echo "<td>".$row["name_surname"]."</td>";
				echo "<td>".$row["subauthor"]."</td>";
				echo "<td>".$row["level"]."</td>";
				for($i = 1; $i < $this->getMeasureCount($competition_id)+1; $i++){
					echo "<td>".$row["time".$i]."</td>";
				}
				echo "</tr>";
			}
		}
	}
	public function getPointResults($competition_id,$year)
	{
		if ($link = spoj_s_db()) {
		$sql = "SELECT robot.name, robot.subauthor, auth.name_surname, point. * FROM  `point_competition` point JOIN  `robot` robot ON point.id_robot = robot.id_robot JOIN  `author` auth ON robot.id_author = auth.id_author JOIN  `competitions` comp ON comp.id = point.id_competition WHERE comp.id = ".$competition_id;
			$result = mysql_query($sql, $link);

			echo "<thead><tr>";

				echo "<th>Názov robota</th>";
				echo "<th>Meno autora</th>";
				echo "<th>Spoluautor</th>";
				echo "<th>Úroveň</th>";
				for($i = 1; $i < $this->getMeasureCount($competition_id)+1; $i++){
					echo "<th>Skóre ".$i."</th>";
				}
				echo "</tr></thead>";
			while ($row = mysql_fetch_assoc($result)) {
				
				echo "<tr>";

				echo "<td>".$row["name"]."</td>";
				echo "<td>".$row["name_surname"]."</td>";
				echo "<td>".$row["subauthor"]."</td>";
				echo "<td>".$row["level"]."</td>";
				for($i = 1; $i < $this->getMeasureCount($competition_id)+1; $i++){
					echo "<td>".$row["score".$i]."</td>";
				}
				echo "</tr>";
			}
		}
	}
	public function getSpecialResults($competition_id,$year)
	{
		if ($link = spoj_s_db()) {
			$sql = "SELECT * FROM `special_competition` WHERE id_competition=".$competition_id;
			$result = mysql_query($sql, $link);

			while ($row = mysql_fetch_assoc($result)) {
				echo "<img src='images/".$row["result"]."' style='max-width:70%; margin:1em;'><br>";
			}
		}
	}

	private function getFormForAddScoreToTimeCompetitionType($competition_id){

		if(isset($_POST["addScoreTime"])){
			$this->checkPost($competition_id);
		} 

			//$html  = "<table style='width:100%'>";
		$html =		"<form method='post'>";
		$html .= 	"<tr>";
		$html .=		"<th>Meno robota</th>";
		$html .=		"<td align='CENTER'><div class='ui input'><input type='text' name = 'name' required></div></td>";
		$html .=		"<th>Úroveň</th>";
		$html .=		"<td align='CENTER'><div class='ui input'><input type='number' name = 'level' required></div></td>";
		$html .=	"</tr>";

		for($i = 0; $i < $this->getMeasureCount($competition_id); $i++){
			$html .= 	"<tr>";
			$html .= 		"<th>Čas ".strval($i+1)."</th>";
			$html .=		"<td align='CENTER'><div class='ui input'><input type='time' step='1' name = 'round".strval($i+1)."'></div></td>";
			$html .=	"</tr>";
		}
		$html .=	"<tr>";
		$html .=	"<input type='text' id='postid' name='postid' value='".$competition_id."' style='width:0; height:0; border:none'>";
		$html .= "<td align='CENTER'><div class='ui input'><input type='submit' value = 'Pridaj' name='addScoreTime' class='positive ui button'></div></td></tr>";
		$html .=	"</form>";
			//$html .="<table>";
		return $html;
	}

	private function getFormForAddScoreToPointCompetitionType($competition_id){

		if(isset($_POST["addScorePoints"])){
			$this->checkPost($competition_id);
		} 
		for($i = 0; $i < $this->getMeasureCount($competition_id); $i++){

		}
			//$html  = "<table style='width:100%'>";
		$html  =	"<form method='post'>";
		$html .= 	"<tr>";
		$html .=		"<th>Meno robota</th>";
		$html .=		"<td align='CENTER'><div class='ui input'><input type='text' name = 'name' required></div></td>";
		$html .=		"<th>Úroveň</th>";
		$html .=		"<td align='CENTER'><div class='ui input'><input type='number' name = 'level' required></div></td>";
		$html .=	"</tr>";



		for($i = 0; $i < $this->getMeasureCount($competition_id); $i++){
			$html .= 	"<tr>";
			$html .= 	"<th>Kolo ".strval($i+1)."</th>";
			$html .=	"<td align='CENTER'><div class='ui input'><input type='number' name = 'round".strval($i+1)."'></div></td>";
			$html .=	"</tr>";
		}
		$html .=	"<tr>";
		$html .=	"<input type='text' id='postid' name='postid' value='".$competition_id."' style='width:0; height:0; border:none'>";
		$html .=	"<td align='CENTER'><div class='ui input'><input type='submit' value = 'Pridaj' class='positive ui button' name='addScorePoints'></div></td></tr>";


		$html .=	"</form>";
			//$html .="<table>";
		return $html;
	}

	private function getFormForAddScoreToSpecialCompetitionType($competition_id){

		if(isset($_POST["addScoreSpecial"])){
			$this->checkPost($competition_id);
		} 
			//$html  = "<table style='width:100%'>";
		$html .=	"<form method='post' enctype='multipart/form-data'>";
		$html .= 	"<tr>";
		$html .= 		"<th>Výsledky</th>";
		$html .=		"<td align='CENTER'><div class='ui input'><input type='file' name='file'></div></td>";
		$html .=	"</tr>";
		$html .= 	"<tr>";


		$html .=			"<td align='CENTER'><div class='ui input'><input type='submit' value = 'Pridaj' name='addScoreSpecial' class='positive ui button'></div></td>";

		$html .=	"</tr>";
		$html .=	"</form>";
//html .="<table>";
		return $html;
	}
	private function updateYearInDatabase(){
			$sql = mysql_query("UPDATE competition_year SET year = '".$_POST["year"]."' WHERE id_cyear = '1' ");
		}


	private function checkPost($competition_id){
		if(isset($_POST["addUser"])){
			$this->insertUserToDatabase();

		}
		else if(isset($_POST["addCompetition"])){
			$this->insertCompetitionToDatabase();
		}
		else if(isset($_POST["addScoreTime"])){
			$this->insertTimeScoreToDatabase($competition_id);
		}
		else if(isset($_POST["addScorePoints"])){
			$this->insertPointsScoreToDatabase($competition_id);
		}
		else if(isset($_POST["addScoreSpecial"])){
			$this->insertSpecialScoreToDatabase($competition_id);
		}
		else if(isset($_POST["changeYear"])){
			$this->updateYearInDatabase();
		}
		
			header('Location: '.$_SERVER['PHP_SELF']);
			die;
	}
	public function changeYear(){

		if(isset($_POST["changeYear"])){
			$this->checkPost(NULL);
		}

		$html  = "<form method='post'>";
		$html .= "<div class='ui input'>";
		$html .=	"<input type='number' name='year'>";
		$html .=	"<input type='submit' value='Zmeniť' name='changeYear' class='ui positive button'>";
		$html .= "</div>";
		$html .= "</form>"; 
		echo $html;
	}
	private function insertTimeScoreToDatabase($competition_id){
		$times = "";
		$results = "";
		for($i=0; $i<$this->getMeasureCount($competition_id); $i++){
			if($i!=0){
				$times   .=", ";
				$results .=", ";
			}
			$times   .= "time".strval($i+1)."";
			$results .="'".$_POST["round".strval($i+1)]."'";
		}
		$id_robot = "";
		$sql = mysql_query("SELECT * FROM robot WHERE name = '".$_POST["name"]."'") or die("Chyba v insert time score (select id robota) trieda FormsController");
		while($res = mysql_fetch_array($sql)){
			$id_robot = $res["id_robot"];
		}
		$competition_id=$_POST["postid"];
		$sql = mysql_query("INSERT INTO time_competition (id_robot, id_competition, level, ".$times.") VALUES ('".$id_robot."', '".$competition_id."', '".$_POST["level"]."', ".$results.")") or die("Chyba v insert time score trieda FormsController");
		
		unset($_POST);
	}

	private function insertPointsScoreToDatabase($competition_id){
		$rounds = "";
		$results = "";
		for($i=0; $i<$this->getMeasureCount($competition_id); $i++){
			if($i!=0){
				$rounds   .=", ";
				$results .=", ";
			}
			$rounds   .="score".strval($i+1);
			$results .="'".$_POST["round".strval($i+1)]."'";
		}
		$id_robot = "";
		$competition_id=$_POST["postid"];
		$sql = mysql_query("SELECT * FROM robot WHERE name = '".$_POST["name"]."'") or die("Chyba v insert points score(select id robota) trieda FormsController");
		while($res = mysql_fetch_array($sql)){
			$id_robot = $res["id_robot"];
		}
		$sql = mysql_query("INSERT INTO point_competition (id_robot, id_competition, level, ".$rounds.") VALUES ('".$id_robot."', '".$competition_id."', '".$_POST["level"]."', ".$results.")") or die("Chyba v insert points score trieda FormsController");
		unset($_POST);
	}

	private function insertSpecialScoreToDatabase($competition_id){
		if(isset($_FILES['file'])){
			$name = $_FILES['file']["name"];
			$ext = pathinfo($name,PATHINFO_EXTENSION);


			if($ext != "jpg" && $ext != "png"){
				echo "Obrázok musí mať príponu jpg alebo png";
				return;
			}
			if(is_dir("/images/results/" )){
				echo "našiel cestu k results<br>";
			}
			else{
				echo "nenašiel cestu....";
			}

			if(is_dir("./../images/results".$name)==false){
				move_uploaded_file($name,"./../images/results".$name);
			}
			else{
				echo"Výsledok súťaže s týmto menom už existuje.";
				return;
			}

			$sql = mysql_query("INSERT INTO special_competition (id_competition, result) VALUES (".$competition_id."', '".$name."')") or die("Chyba v insert special  trieda FormsController");
			unset($_POST);
		}
		else{
			echo "chyba pri vkladani obrazka";
			return;
		}
			
	}

	private function getMeasureCount($competition_id){
		$sql = mysql_query("SELECT * FROM competitions WHERE id = '".$competition_id."'") or die("Chyba v getMeasureCount trieda FormsController");
		while($res = mysql_fetch_array($sql)) {
			return $res["measure_count"];
		}		
	}

	private function getTypeOfCompetition($competition_id){
		$sql = mysql_query("SELECT * FROM competitions WHERE id = '".$competition_id."'") or die("Chyba v getTypeOfCompetition trieda FormsController");
		while($res = mysql_fetch_array($sql)) {
			return $res["id_type_of_competition"];
		}	
	}

	private function insertUserToDatabase(){
		$password = md5($_POST["password"]);
		$sql = mysql_query("INSERT INTO author (name_surname, age, job, email, state, town, contact, passwd)
			VALUES ('".$_POST["name"]."', '".$_POST["age"]."', '".$_POST["job"]."', '".$_POST["email"]."', '".$_POST["country"]."', '".$_POST["city"]."', '".$_POST["address"]."','".$password."' )") or die(mysql_error());
	}

	private function insertCompetitionToDatabase(){
		require_once("CompetitionYear.php");
		$year = CompetitionYear::getCurrentYear();
		debug_to_console("hm".$_POST["measure_count"]);
		$sql = mysql_query("INSERT INTO competitions (name, sign_in_deadline, year, measure_count, id_type_of_competition)
			VALUES ('".$_POST["name"]."', '".$_POST["deadline"]."', '".$year."', '".$_POST["measure_count"]."', '".$_POST["competition_type"]."')") or die(mysql_error());

	}

}
function debug_to_console( $data ) {

	if ( is_array( $data ) )
		$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	else
		$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	echo $output;
}
?>

<!-- Validation script -->
<script type="text/javascript">

	function checkForm(form)
	{
		if(form.password.value != "" && form.password.value == form.password_varification.value) {
			form.submit();
			return true;
		} else {
			alert("Error: Heslá sa nezhodujú!");
			return false;
		}
	}
</script>