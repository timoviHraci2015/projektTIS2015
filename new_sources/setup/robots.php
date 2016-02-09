	<?php	
		//session_start();
		openMySQL($host, $user, $passwd, $db);
		if (!isset($_SESSION['sudo'])) {
			redir("index.php?page=logme");
		} else{
			if (isset($_POST['show'])) {	
				$sql = mysql_query("select year from competition_year where id_cyear = 1") or die ("ERROR: ".mysql_error());
				$competition = mysql_fetch_object($sql);
				$_SESSION['year'] = $competition->year;
				//echo "edit: ".$_SESSION['year'];
				mysql_query("UPDATE robot SET `show` = 1 WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
				mysql_query("UPDATE category_tag SET year = '".$_SESSION['year']."' WHERE id_robot = '".$_POST['id']."'") or die("Error update CATEGORY_TAG: ".mysql_error()."");
			
			} elseif (isset($_POST['del'])) {
				mysql_query("DELETE FROM robot WHERE id_robot = '".$_POST['id']."'") or die ("ERROR delete robot: ".mysql_error());
				//zmazanie dat v tabulke CATEGORY_TAG
				mysql_query("DELETE FROM category_tag WHERE id_robot = '".$_POST['id']."'") or die ("ERROR delete categ: ".mysql_error());
			
			}  elseif (isset($_POST['set'])) {
				//fei
				if (isset($_POST['fei'])){
					mysql_query("UPDATE robot SET fei = 1 WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
				} else {
					mysql_query("UPDATE robot SET fei = 0 WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
				}
				
				//arduino
				if (isset($_POST['arduino'])){
					mysql_query("UPDATE robot SET arduino = 1 WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
				} else {
					mysql_query("UPDATE robot SET arduino = 0 WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
				}	
				
				//lego	
				if (isset($_POST['lego'])){
					mysql_query("UPDATE robot SET lego = 1 WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
				} else {
					mysql_query("UPDATE robot SET lego = 0 WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
				}	
			}
		}
	?>
	
	<DIV Id="content">
		
		<H3 id="statistics">Zoznam všetkých robotov:</H3>

				 <?php
					//vyber zoznam vsetkych robotov
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("SELECT robot.id_robot, robot.name, author.name_surname, robot.show, robot.fei, robot.arduino, robot.lego FROM robot INNER JOIN author ON robot.id_author = author.id_author");
					while ($robot = mysql_fetch_object($sql)) {
							echo "<FORM Action=\"index.php?page=robots\" Method=\"POST\">";
							echo "<TABLE class=\"usr\"><TR><TD></TD><TD></TD><TD></TD><TD></TD>";
							echo "<TD><img src=\"../images/icon/fei.gif\" alt=\"fei\"></TD>";
							echo "<TD><img src=\"../images/icon/ardu.gif\" alt=\"arduino\"></TD>";
							echo "<TD><img src=\"../images/icon/lego.gif\" alt=\"lego\"></TD>";
							echo "<TD></TD><TD></TD><TD></TD></TR><TR>";
							
							if ($robot->name != ""){
								echo "<TD class=\"input_rbt\"><a href=\"index.php?page=robot&id=".$robot->id_robot."\">".$robot->name."</a></TD>";
							} else {
								echo "<TD class=\"input_rbt_data\"><i>Bez názvu</i></TD>";
							}
							echo "<TD class=\"input_rbt_data\">".$robot->name_surname."</TD>";
							if ($robot->show == 1){
								echo "<TD class=\"input_rbt_data\">Evidovaný</TD>";
							} else {
								echo "<TD class=\"input_rbt_data\">Zmazaný</TD>";
							}
							echo "<TD><INPUT Type=\"hidden\" name=\"id\" Value=".$robot->id_robot."></TD>";
							
							if ($robot->fei == 0){
								echo "<TD><INPUT Type=\"checkbox\" name=\"fei\"></TD>";
							} else {
								echo "<TD><INPUT Type=\"checkbox\" name=\"fei\" checked=\"checked\"></TD>";
							}
							
							if ($robot->arduino == 0){	
								echo "<TD><INPUT Type=\"checkbox\" name=\"arduino\"></TD>";
							} else {
								echo "<TD><INPUT Type=\"checkbox\" name=\"arduino\" checked=\"checked\"></TD>";
							}
							
							if ($robot->lego == 0){	
								echo "<TD><INPUT Type=\"checkbox\" name=\"lego\"></TD>";
							} else {
								echo "<TD><INPUT Type=\"checkbox\" name=\"lego\" checked=\"checked\"></TD>";
							}
							
							echo "<TD><INPUT Type=\"submit\" name=\"set\" Value=\"Potvrď\"></TD>";
							
							echo "<TD><INPUT Type=\"submit\" name=\"del\" Value=\"Zmaž\"></TD>";
							echo "<TD><INPUT Type=\"submit\" name=\"show\" Value=\"Obnov\"></TD>";
							echo "</TR></TABLE></FORM>";

						}
				 ?> 
	</DIV><!-- Content -->