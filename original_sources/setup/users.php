	<?php	
		//session_start();		
		if (!isset($_SESSION['sudo'])) {
			redir("index.php?page=logme");
		} else{
			if (isset($_POST['update_mail'])) {
				openMySQL($host, $user, $passwd, $db);
				mysql_query("UPDATE author SET email = '".$_POST['email']."' WHERE id_author = '".$_POST['id']."'")or die ("ERROR update email: ".mysql_error());
			} elseif (isset($_POST['update_pasw'])) {
				mysql_query("UPDATE author SET passwd = '".md5($_POST['pasw'])."' WHERE id_author = '".$_POST['id']."'")or die ("ERROR update passwd: ".mysql_error());
			}  elseif (isset($_POST['del'])) {
				//zmazanie uzivatela
				mysql_query("DELETE FROM author WHERE id_author = '".$_POST['id']."'") or die ("ERROR delete author: ".mysql_error());
				//zmazanie dat v tabulke CATEGORY_TAG
				$sql = mysql_query("SELECT id_robot FROM robot WHERE id_author = '".$_POST['id']."'") or die ("ERROR select robot: ".mysql_error());
					while ($robot = mysql_fetch_object($sql)) {
						mysql_query("DELETE FROM category_tag WHERE id_robot = '".$robot->id_robot."'") or die ("ERROR delete categ: ".mysql_error());
					}	
				//zmazanie zaznamov v tabulke ROBOT
				mysql_query("DELETE FROM robot WHERE id_author = '".$_POST['id']."'") or die ("ERROR delete robot: ".mysql_error());

			}  
		}
	?>
	
	<DIV Id="content">
		
		<H3 id="statistics">Zoznam všetkých užívateľov:</H3>

				 <?php
					//vyber zoznam vsetkych uzivatelov
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("SELECT id_author, name_surname, email FROM author");
					while ($user = mysql_fetch_object($sql)) {
							echo "<FORM Action=\"index.php?page=users\" Method=\"POST\">";
							echo "<TABLE class=\"usr\"><TR>";
							echo "<TD class=\"input_usr\"><a href=\"index.php?page=user&id=".$user->id_author."\">".$user->name_surname."</a></TD>";
							echo "<TD class=\"input_rbt_data\"><INPUT Type=\"text\" name=\"email\" Value=".$user->email."></TD>";
							echo "<TD><INPUT Type=\"password\" name=\"pasw\" Size=\"8\" Value=\"urpi\"></TD>";
							echo "<TD><INPUT Type=\"submit\" name=\"update_mail\" Value=\"Uprav mail\"></TD>";
							echo "<TD><INPUT Type=\"submit\" name=\"update_pasw\" Value=\"Uprav heslo\"></TD>";
							echo "<TD><INPUT Type=\"submit\" name=\"del\" Value=\"Zmaž\"></TD>";
							echo "<TD><INPUT Type=\"hidden\" name=\"id\" Value=".$user->id_author."></TD>";
							echo "</TR></TABLE></FORM>";

						}
				 ?> 
	</DIV><!-- Content -->