<?php	
		//session_start();
	//echo "SUDO: ".$_SESSION['sudo'];
	if ($_SESSION['sudo'] == "") {
		if (isset($_GET['log'])) {
			$login = $_POST['login'];
			$pasw = $_POST['pasw'];
			//ziskanie md5(heslo) z DB
			$pasw_db = "";
			openMySQL($host, $user, $passwd, $db);
			
			// prihlasenie uzivatela	
			$sudo = mysql_query("select * from admin where name ='".$login."'") or die ("ERROR: ".mysql_error());
			if ($sudo) {
				if (mysql_num_rows($sudo) == 0) {
					$errmsg2 = "Chybne udaje";
				}
				else {
					$sudo_data = mysql_fetch_object($sudo);
					$sudo_pasw = $sudo_data->passwd;
					if ($sudo_pasw == md5($pasw)){
					//definovanie $_SESSION pre vytvorenie spojenia
						$_SESSION['sudo'] = $sudo_data->name;
						redir("index.php?page=setup");
					} else{
						$errmsg2 = "Chybne udaje";
					}	
				}
					
			}
		}
	} elseif ($_GET['page'] == "logout") {
		//logout
		$_SESSION['sudo'] = "";
		redir("index.php");
	}	
?>
		<div id="content">
			<FORM Action="index.php?page=logme&log" Method="POST">
				<TABLE class="form">
					<TR><TD class="title_lm" colspan="2"><h3>Admin login:</h3></TD></TR>
					<TR><TD class="title_lm">Name:</TD>
					<TD class="input_lm"><INPUT Type="text" Name="login" Size="20"><?php echo $errmsg2; ?></td></TR>							
					<TR><TD class="title_lm">Password:</td>
					<TD class="input_lm"><INPUT Type="password" Name="pasw" Size="20"></TD></TR>
					<tr><TD class="title_lm"></TD><td class="input_lm"><INPUT Type="submit" Value="Prihlásiť sa"></td></tr>
				</TABLE>
			</FORM>
		</div>