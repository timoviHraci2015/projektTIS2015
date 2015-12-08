f<?php
		//session_start();
		if (isset($_GET['log'])) {
			$login = $_POST['login'];
			$pasw = $_POST['pasw'];
			//ziskanie md5(heslo) z DB
			$pasw_db = "";
			openMySQL($host, $user, $passwd, $db);
			
			// prihlasenie uzivatela	
			$sql_pasw = mysql_query("select * from author where email ='".$login."'") or die ("Chyba select author: ".mysql_error());
			if ($sql_pasw) {
				if (mysql_num_rows($sql_pasw) == 0) {
					$errmsg2 = "Neregistrovany email";
				}
				else {
					$author = mysql_fetch_object($sql_pasw);
					$aid = $author->id_author;
					//po aktivacii usera su jeho data v tabulke activation premazane
					$sql_act = mysql_query("select * from activation where id_author ='".$aid."'") or die ("Chyba select active: ".mysql_error());	
					if (mysql_num_rows($sql_act) == 0) {
						$pasw_db = $author->passwd;
						if ($pasw_db == md5($pasw)){
						//nulovanie $_SESSION pre mozne kolizie z prihlasovania
							$_SESSION['mail'] = "";
							$_SESSION['pasw'] = "";
							$_SESSION['category'] = "";
							$_SESSION['robot'] = "";
							$_SESSION['author'] = "";
							$_SESSION['author_id'] =  "";
							$_SESSION['newlog'] = "";
							$_SESSION['a_id'] = $author->id_author;
							$_SESSION['author'] = $author->name_surname;
							$_SESSION['mail'] = $author->email;
							redir("index.php?page=login");								
						} else{
							$errmsg2 = "Chybne heslo.";
						}
					} else {
							$errmsg2 = "Účet nebol aktivovaný!";
					}			
				}	
			}
		}
		
		// registracia noveho uzivatela
		if (isset($_GET['new'])) {
			//echo $_POST['login_new'];		
			if (check_mail($_POST['login_new']) && check_exist_user($_POST['login_new'])){
				redir("index.php?page=login&new=".$_POST['login_new']);
			}else {
				$errmsg1 = "Zle zadany mail!";
			}
			
		}		
?>
		<div id="content">
			<div style="text-align: center;">
				<b>&nbsp1. Registrácia účastníka </b><i>----> 2. Registrácia robota/robotov ----> 3. Potvrdenie, koniec</i>
				<br/><br/>
			</div>
			<FORM Action="index.php?page=logme&new" Method="POST">
				<TABLE class="form_logme"> 
					<TR><TD class="title_lm">Email:</TD>
					<TD class="input_lm"><INPUT Type="text" Name="login_new" Size="20"><?php echo $errmsg1; ?></td></TR>
					<tr><TD class="title_lm"></td><td class="input_lm"><INPUT Type="submit" Value="Registrovať"></td></tr>			
				</TABLE>				
			</FORM>
			<br/>
			<FORM Action="index.php?page=logme&log" Method="POST">
				<TABLE class="form_logme"> 
					<TR><TD class="title_lm">Email:</TD>
					<TD class="input_lm"><INPUT Type="text" Name="login" Size="20"><?php echo $errmsg2; ?></td></TR>							
					<TR><TD class="title_lm">Heslo:</td>
					<TD class="input_lm"><INPUT Type="password" Name="pasw" Size="20"></TD></TR>
					<tr><TD class="title_lm"></TD><td class="input_lm"><INPUT Type="submit" Value="Prihlásiť sa"></td></tr>
				</TABLE>
			</FORM>
		</div>