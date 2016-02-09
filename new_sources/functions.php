<?php
	require_once("config.php");
	
	function openMySQL($host, $user, $pass, $db) {
		$link = mysql_connect($host, $user, $pass) or die("Nejde sa pripojit k MySQL: " . mysql_error());
		$dbsel = mysql_select_db($db, $link) or die("Nejde vybrat databazu: ". mysql_error());
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_connection=utf8");
	}
	
	function check_mail($email) {
		$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
		if (preg_match(preg_match,$email)) {
			return true;
		} 
		return false;
	}
		
	//skontroluje ci zadany email uz neni registrovany
	function check_exist_user($id) {
			$sql = mysql_query("select * from author where email = '".$id."'") or die ("TOTO:".mysql_error());
				if (mysql_num_rows($sql) == 0) {
					return true;
				}else {
					return false;		
				}	
			}
	
	function random_num() {
			$length = 6;
			$characters = "0123456789";
			$string = "";    

			for ($p = 0; $p < $length; $p++) {
				$string .= $characters[mt_rand(0, strlen($characters))];
			}
			
			$length = 6-strlen($string);
			
			if ($length == 0) return $string;
			else {
				for ($i=1; $i<=$length; $i++) $string .= $characters[mt_rand(0, strlen($characters))];
				return $string;
			}
		}

	
	function redir($url) {
		echo "<script type=\"text/javascript\">
								<!--
									window.location = \"".$url."\"
								//-->
								</script>";
	}

	
	function isnum($x) {
		if (preg_match('/^[0-9]*$/',$x)) return true;
		return false;
	}
	
	function isLogged() {
		if (isset($_SESSION['user_id']) && isset($_SESSION['password']) && isset($_SESSION['login'])) {
			$sql = @mysql_query("select user_id from users where email = '".$_SESSION['login']."' and password = '".$_SESSION['password']."'");
			if (mysql_num_rows($sql) > 0) return true;
			else return false;
		} else {
			return false;
		}
	}
	
	function isnum_age($x) {
		if (preg_match('/^[0-9]*$/',$x) && (strlen($x)<3)) return true;
		return false;
	}
	
	function activate_hash($login, $pass, $time) {
		return md5($login.$pass.$time);
	}
	
	function sendmail($to, $hash, $pass) {
		$from = "info@robotika.sk";
		$subject = "Aktivacny email sutaze Istrobot";

		//begin of HTML message
		$message = "<html><body>
		Vas prihlasovaci mail je <b><u>".$to."</u></b><br />
		Vase heslo je <b><u>".$pass."</u></b><br />
		Kliknite na link alebo ho skopirujte a vlozte do URL adresy vasho prehliadaca.
        <a href=\"http://www.robotika.sk/contest/2013/activate.php?hash=".$hash."\">http://www.robotika.sk/contest/2013/activate.php?hash=".$hash."</a>
		<br /><br /><hr />
		ISTROBOT
		</body>
		</html>";
		//end of message

		// To send the HTML mail we need to set the Content-type header.
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers  .= "From: $from\r\n";
    
		mail($to, $subject, $message, $headers);	
	}
	
	function sendmailAdmin($author) {
		
		//OTESTOVAT!!!
		//data do databazy, nejde cez require :/
		$host = "localhost";
		$user = "istrobot";
		$passwd = "robo1ika"; 
		$db = "istrobot";

		//data od autora
		openMySQL($host, $user, $passwd, $db);
		$sql = mysql_query("select * from author where id_author ='".$author."'") or die(mysql_error());
		$user = mysql_fetch_object($sql);
		
		//zaregistrovane roboty autora
		$sql2 = mysql_query("SELECT DISTINCT robot.name FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot WHERE robot.id_author = '".$author."' AND category_tag.year='".$_SESSION['year']."'") or die(mysql_error());;
		
		//begin of HTML message
		$message = "<html><body>
		<b>Meno/a: </b>";
		while ($robot = mysql_fetch_object($sql2)) {
				$message = $message."".$robot->name.", ";
		}
		if ($user->age == 0) {$age = "nezadany";} else {$age = $user->age;}
		$message = $message."<br/><b>Autor:</b> ".$user->name_surname."
		<br/><b>Vek: </b>".$age."
		<br/><b>Praca: </b>".$user->job."
		<br/><b>Adresa: </b>".$user->town."
		<br/><b>Kontakt.: </b>".$user->contact."
		<br/><b>Email: </b>".$user->email."
		<br/><br/>
		ISTROBOT ".$_SESSION['year']."
		</body>
		</html>";
		//end of message
		
		$subject = "[Istrobot ".$_SESSION['year']."] Prihlaska";
		$to = "balogh@elf.stuba.sk";
		//$to = "mstevanak@gmail.com";
		$from = $user->email;
		
		// To send the HTML mail we need to set the Content-type header.
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers  .= "From: $from\r\n";
		
		mail($to, $subject, $message, $headers);	
	}
	
	function sendmailAdminDel($author,$robot) {
		
		//OTESTOVAT!!!
		//data do databazy, nejde cez require :/
		$host = "localhost";
		$user = "istrobot";
		$passwd = "robo1ika"; 
		$db = "istrobot";

		//data od autora
		openMySQL($host, $user, $passwd, $db);
		$sql = mysql_query("select * from author where id_author ='".$author."'") or die(mysql_error());
		$user = mysql_fetch_object($sql);
		
		//zaregistrovane roboty autora
		$sql2 = mysql_query("SELECT name FROM robot WHERE id_robot = '".$robot."'") or die(mysql_error());;
		
		//begin of HTML message
		$message = "<html><body>
		<b>Meno/a: </b>";
		while ($robot = mysql_fetch_object($sql2)) {
				$message = $message."".$robot->name;
		}
		if ($user->age == 0) {$age = "nezadany";} else {$age = $user->age;}
		$message = $message."<br/><b>Autor:</b> ".$user->name_surname."
		<br/><b>Vek: </b>".$age."
		<br/><b>Praca: </b>".$user->job."
		<br/><b>Adresa: </b>".$user->town."
		<br/><b>Kontakt.: </b>".$user->contact."
		<br/><b>Email: </b>".$user->email."
		<br/><br/>
		ISTROBOT ".$_SESSION['year']."
		</body>
		</html>";
		//end of message
		
		$subject = "[Istrobot ".$_SESSION['year']."] Odhlasenie robota";
		$to = "balogh@elf.stuba.sk";
		//$to = "mstevanak@gmail.com";
		$from = $user->email;
		
		// To send the HTML mail we need to set the Content-type header.
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers  .= "From: $from\r\n";
		
		mail($to, $subject, $message, $headers);	
	}
	
	function secure($x) {
		$arr = array("<", ">", "#", "/", "\"", "--", ";", "<!--");
		$x = nl2br(str_replace($arr, "", $x));
		return addslashes($x);
	}
?>