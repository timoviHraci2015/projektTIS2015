<?php

class EmailSender { 

	const MAIL_FROM = "tis_noreply@andray.eu";
	const MAIL_TO   = "sumera.martin@gmail.com";

	public static function sendAdminNotificationNewAuthor($authorId) {
		$sender   = "ISTROBOT: Nova registracia";
		$subject  = "ISTROBOT: Nova registracia";  

		echo "email___".$authorId."_____";

		$sql = mysql_query("select * from author where id_author ='".$authorId."'") or die(mysql_error());
		$user = mysql_fetch_object($sql);

		$message = "<html><body>";
		$message .= "<h3>Nova registracia</h3>";

		$sql = mysql_query("SELECT DISTINCT robot.name FROM robot WHERE robot.id_author = '".$author."'") or die(mysql_error());;
		$message .= "<b>Meno/a: </b>";
		while ($robot = mysql_fetch_object($sql)) {
				$message = $message."".$robot->name.", ";
		}

		$message .= "<br/><b>Autor:</b> ".$user->name_surname;

		if($user->age != 0) {
			$message .= "<br/><b>Vek: </b>".$user->age;
		}
		
		$message .= "<br/><b>Praca: </b>".$user->job;
		$message .= "<br/><b>Adresa: </b>".$user->town;
		$message .= "<br/><b>Kontakt: </b>".$user->contact;
		$message .= "<br/><b>Email: </b>".$user->email;
		$message .= "</body></html>";

		return mail(EmailSender::MAIL_TO, $subject, $message, EmailSender::generatePlainTextHeader());
	}

	public static function sendActivationEmail($to, $hash, $pass) {
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
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: ".EmailSender::MAIL_FROM."\r\n";
    
		mail($to, $subject, $message, EmailSender::generatePlainTextHeader());	
	}

	public static function sendNewPassword($email) {
		$sql = mysql_query("SELECT * FROM author WHERE id_author ='".$authorId."'") or die(mysql_error());
		$user = mysql_fetch_object($sql);
	}

	public static function validate($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	private static function generatePlainTextHeader() {
		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=utf-8\r\n";
		$header .= "From: ".EmailSender::MAIL_FROM."\r\n";

		echo $header;
		return $header;
	}

}

?> 
