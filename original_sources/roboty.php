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
			$cat_name = array();
			$cat_id = array();
			$i=1;
			openMySQL($host, $user, $passwd, $db);
			$sql = mysql_query("SELECT id_category, name FROM category");
			while ($category = mysql_fetch_object($sql)) {
				$cat_name[$i] = $category->name;
				$cat_id[$i] = $category->id_category;
				echo "<LI><A HREF=\"#".$cat_id[$i]."\">".$cat_name[$i]."</A></li>";
				$i++;
			}
		?>
		</UL>
		<?
		// $i-poc kategorii, $j-premenna pre kazdu kategoriu, $k-premenna pre kazdeho robota danej kategorie
			for ($j=1; $j<$i; $j++){
				echo "<H3 id=\"".$cat_id[$j]."\">".$cat_name[$j]."</H3>";
				// VYPIS ROBOTOV ID CATEGORY = $cat_id[$j], SHOW = 1!
				$sql = mysql_query("SELECT category_tag.id_category, category_tag.start_num, author.name_surname, author.town, author.state, 
							robot.name, robot.subauthor, robot.show, robot.fei, robot.arduino, robot.lego, robot.id_robot 
							FROM author INNER JOIN robot ON author.id_author = robot.id_author JOIN category_tag ON robot.id_robot = category_tag.id_robot 
							WHERE category_tag.id_category = '".$cat_id[$j]."' AND category_tag.year = '".$_SESSION['year']."'") or die(mysql_error());
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
					$sql = mysql_query("SELECT COUNT(DISTINCT category_tag.id_robot ) FROM category_tag INNER JOIN robot ON category_tag.id_robot = robot.id_robot WHERE category_tag.year = '".$_SESSION['year']."' AND robot.show = 1");
					$sum = mysql_fetch_row($sql);
					echo $sum[0];
				 ?> 
				 Spolu
			 </li>
			 <br/>
			 <?php
				for ($j=1; $j<$i; $j++){
					echo "<LI>";
					$sql = mysql_query("SELECT COUNT(category_tag.id_robot) FROM category_tag INNER JOIN robot ON category_tag.id_robot = robot.id_robot WHERE category_tag.year = '".$_SESSION['year']."' AND robot.show = 1 AND id_category = '".$cat_id[$j]."'");
					$sum = mysql_fetch_row($sql);		 
					echo $sum[0]." ".$cat_name[$j]." </li>";
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