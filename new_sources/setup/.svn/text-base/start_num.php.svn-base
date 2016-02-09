	<?php	
		require_once("config.php");
		require_once("functions.php");
		openMySQL($host, $user, $passwd, $db);
			if (isset($_POST['set'])) {
				mysql_query("UPDATE category_tag SET start_num = '".$_POST['start']."' WHERE id_robot = '".$_POST['id']."'")or die ("ERROR update: ".mysql_error());
			}	
	?>
	
	<DIV Id="content">		
				 <?php
					//vyber zoznam vsetkych robotov
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("SELECT DISTINCT(robot.id_robot), robot.name, category_tag.start_num FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot");
					while ($robot = mysql_fetch_object($sql)) {
							echo "<FORM Action=\"start_num.php\" Method=\"POST\">";
							echo "<TABLE class=\"usr\"><TR><TD>";
							echo "<TD class=\"input_rbt\">><INPUT Type=\"text\" name=\"id\" value=\"".$robot->id_robot."\"></TD>";
							echo "<TD class=\"input_rbt\"><b>".$robot->name."</b></TD>";
							echo "<TD class=\"input_rbt\">".$robot->start_num."</TD>";
							echo "<TD class=\"input_rbt\"><INPUT Type=\"text\" name=\"start\"></TD>";
							echo "<TD><INPUT Type=\"submit\" name=\"set\" Value=\"Potvrd\"></TD>";
							echo "</TR></TABLE></FORM>";
						}
				 ?> 
	</DIV>