

		<DIV Id="content">

		<H2>Prihlásení</H2>

		<FONT Size="1">
			Na tejto stránke postupne budú pribúdat prihlásené roboty.
			Ak nie ste v zozname, znamená to, že som ešte nedostal Vašu prihlášku.
			Ozvite sa co najskôr na adresu 'balogh@elf.stuba.sk'.
		</FONT>

		<H3>Index</H3>
		<UL>
		<?
			$competition_name = array();
			$competition_id = array();
			$i=1;
			openMySQL($host, $user, $passwd, $db);
			$sql = mysql_query("SELECT * FROM competitions WHERE year='".CompetitionYear::getCurrentYear()."'");
			while ($competition = mysql_fetch_object($sql)) {
				$competition_name[$i] = $competition->name;
				$competition_id[$i] = $competition->id;
				echo "<LI><A HREF=\"#".$competition_id[$i]."\">".$competition_name[$i]."</A></li>";
				$i++;
			}
		?>
		</UL>
		<?

		openMySQL($host, $user, $passwd, $db);

		// $i-poc kategorii, $j-premenna pre kazdu kategoriu, $k-premenna pre kazdeho robota danej kategorie
			for ($j=1; $j<$i; $j++){
				echo "<H3 id=\"".$competition_id[$j]."\">".$competition_name[$j]."</H3>";
				// VYPIS ROBOTOV ID CATEGORY = $cat_id[$j], SHOW = 1!
				$sql = mysql_query("SELECT competitions_contestants.competition_id, competitions_contestants.start_number, author.name_surname, author.town, author.state, 
							robot.name, robot.subauthor, robot.show, robot.fei, robot.arduino, robot.lego, robot.id_robot 
							FROM author 
							INNER JOIN robot ON author.id_author = robot.id_author JOIN competitions_contestants ON robot.id_robot = competitions_contestants.robot_id 
						    JOIN competitions ON competitions_contestants.competition_id = competitions.id
							WHERE competitions_contestants.competition_id = '".$competition_id[$j]."' AND competitions.year = '".CompetitionYear::getCurrentYear()."'") or die(mysql_error());
				
				$k=1;
				while ($robot = mysql_fetch_object($sql)) {
					if ($robot->show == 1){
						if ($robot->start_num == 0){
							if ($robot->subauthor == ""){
								echo "&nbsp &nbsp &nbsp".$k.". Robot <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.") ".$robot->town;
							} else {
								echo "&nbsp &nbsp &nbsp".$k.". Robot <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.", ".$robot->subauthor.") ".$robot->town;
							}
						} else{
							if ($robot->subauthor == ""){
								echo "&nbsp &nbsp &nbsp".$k.". #".$robot->start_num." Robot <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.") ".$robot->town;
							} else {
								echo "&nbsp &nbsp &nbsp".$k.". #".$robot->start_num." Robot <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.", ".$robot->subauthor.") ".$robot->town;
							}						
						}
						
						//STATE,  IMAGES FEI,ARDUINO, LEGO
							if ($robot->state == "CR"){
								echo " <img src=\"images/icon/czech.gif\" alt=\"czech\">";
							} elseif ($robot->state == "PL"){
								echo " <img src=\"images/icon/polska.gif\" alt=\"polska\">";
							} elseif ($robot->state == "AUT"){
								echo " <img src=\"images/icon/aus.jpg\" alt=\"aus\">";
							} elseif ($robot->state == "GER"){
								echo " <img src=\"images/icon/ger.gif\" alt=\"ger\">";
							}
							
							
							if ($robot->fei == 1){
								echo " <img src=\"images/icon/fei.gif\" alt=\"fei\">";
							}
							
							if ($robot->arduino == 1){
								echo " <img src=\"images/icon/ardu.gif\" alt=\"arduino\">";
							}
							
							if ($robot->lego == 1){
								echo " <img src=\"images/icon/lego.gif\" alt=\"lego\">";
							}
													
							echo "<br>";
						
					} else {
						echo "&nbsp &nbsp &nbsp<strike>".$k.". Robot <b>".$robot->name."</b> (".$robot->name_surname.") ".$robot->town."</strike><br/>";
					}					
					$k++;
				}
			}
		?>

		<H3 id="statistics">Štatistiky</H3>

		Počty prihlásených robotov:

		<UL>
			 <LI>
				 <?php
					//mozno preupravit podla zadanych sutazi pre dany rok, pre show = 0 nepocitat!
					$sql = mysql_query("SELECT COUNT(DISTINCT competitions_contestants.robot_id ) FROM competitions_contestants INNER JOIN robot ON competitions_contestants.robot_id = robot.id_robot JOIN competitions ON competitions.id = competitions_contestants.competition_id WHERE competitions.year = '".$_SESSION['year']."' AND robot.show = 1");
					$sum = mysql_fetch_row($sql);
					echo $sum[0];
				 ?> 
				 Spolu
			 </li>
			 <br/>
			 <?php
				for ($j=1; $j<$i; $j++){
					echo "<LI>";
					$sql = mysql_query("SELECT COUNT(competitions_contestants.robot_id) FROM competitions_contestants INNER JOIN robot ON competitions_contestants.robot_id = robot.id_robot JOIN competitions ON competitions.id = competitions_contestants.competition_id WHERE competitions.year = '".$_SESSION['year']."' AND robot.show = 1 AND id_category = '".$competition_idt[$j]."'");
					$sum = mysql_fetch_row($sql);		 
					echo $sum[0]." ".$competition_name[$j]." </li>";
				}	
			?>
		</UL>

		
		Stav ku dňu: 
		<?php
			$today = date("d. m. Y, H:i:s");
			echo $today;
		?>
		<BR/>

		</DIV><!-- Content -->