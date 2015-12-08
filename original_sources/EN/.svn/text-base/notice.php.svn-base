
		<div Id="content">
			<?php
				if ( !empty($_SESSION['mail']) && !empty($_SESSION['pasw']) && !isset($_GET['action'])) {
					echo "Registration for the competition was successful <br/>";
					//echo "Vaše prihlasovacie meno pre zmenu údajov je: <b>".$_SESSION['mail']."</b> a heslo: <b>".$_SESSION['pasw']."</b>.";
					$_SESSION['mail'] = "";
					$_SESSION['pasw'] = "";
					
					} elseif (isset($_SESSION['a_login'])) {
						echo "You have successfully logged";
					} elseif (!isset($_SESSION['a_login']) && !isset($_GET['action'])){
						echo "You have successfully logged out";
					} elseif ($_GET['action'] == 'active'){
						echo "Account has been activated successfully";
					} elseif ($_GET['action'] == 'inactive'){
						echo "Error verification account or the account has already been activated!";
					} elseif ($_GET['action'] == 'new'){
						echo "You have successfully registered for the competition!";
					} elseif ($_GET['action'] == 'exist'){
						echo "You have successfully registered for the competition!";
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