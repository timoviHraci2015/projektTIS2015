
		<div Id="content">
			<?php
				if ( !empty($_SESSION['mail']) && !empty($_SESSION['pasw']) && !isset($_GET['action'])) {
					echo "Registrácia do súťaže prebehla úspešne <br/>";
					echo "Vaše prihlasovacie meno pre zmenu údajov je: <b>".$_SESSION['mail']."</b> a heslo: <b>".$_SESSION['pasw']."</b>.";
					$_SESSION['mail'] = "";
					$_SESSION['pasw'] = "";
					
					} elseif (isset($_SESSION['a_login'])) {
						echo "Boli ste úspešne prihlásený";
					} elseif (!isset($_SESSION['a_login']) && !isset($_GET['action'])){
						echo "Boli ste úspešne odhlásený";
					} elseif ($_GET['action'] == 'active'){
						echo "Účet bol úspešne aktivovaný.";
					} elseif ($_GET['action'] == 'inactive'){
						echo "Chyba verifikácie účtu alebo daný účet už bol aktivovaný!";
					} elseif ($_GET['action'] == 'new'){
						echo "Boli ste úspešne registrovaný do súťaže!";
					} elseif ($_GET['action'] == 'exist'){
						echo "Boli ste úspešne zaregistrovaný do súťaže!";
						$_SESSION['a_id'] = "";
						$_SESSION['author'] = "";
						$_SESSION['robot_id'] = "";
						$_SESSION['r_id'] = "";
						
					}
					
					if ($_GET['page'] == "logout"){
						$_SESSION['a_id'] = "";
						$_SESSION['author'] = "";
						redir("index.php?page=notice");	
					}
			?>	
		</div>