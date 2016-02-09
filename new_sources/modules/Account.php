<?php

class Account {

	public static function emailExist($email) {
		$sql = mysql_query("SELECT * FROM author WHERE email = '".mysql_real_escape_string(secure($email))."'") or die(mysql_error());
		
		$results = array();
		while($res = mysql_fetch_array($sql)) {
			array_push($results, $res);
		}

		return count($results) == 1;
	}
	
	public static function resetPassword($email) {
		if(!Account::emailExist($email)) {
			return false;
		}

		$newPassword = Account::generatePassword();
		$newPasswordHash = md5($newPassword);

		$sql = mysql_query("UPDATE author SET passwd='".$newPasswordHash."' WHERE email ='".mysql_real_escape_string(secure($email))."'") or die(mysql_error());	

		EmailSender::sendNewPasswordEmail($email, $newPassword);

		return true;
	}

	private static function generatePassword($length = 5) {
	    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	    $count = mb_strlen($chars);

	    for ($i = 0, $result = ''; $i < $length; $i++) {
	        $index = rand(0, $count - 1);
	        $result .= mb_substr($chars, $index, 1);
	    }

	    return $result;
	}

}

?>