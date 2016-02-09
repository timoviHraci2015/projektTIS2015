	<DIV Id="content">

		<H2>Výsledková listina</H2>

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
			//STOPAR
			$j=1;
				echo "<H3 id=\"".$cat_id[$j]."\">".$cat_name[$j]."</H3>";
				
				// VYPIS ROBOTOV ID CATEGORY = 1
				$sql = mysql_query("SELECT category_tag.id_category, category_tag.start_num, author.name_surname, author.town, author.state, 
							robot.name, robot.show, robot.fei, robot.arduino, robot.lego, robot.id_robot, linefollower.* FROM author 
							INNER JOIN robot ON author.id_author = robot.id_author 
							JOIN category_tag ON robot.id_robot = category_tag.id_robot 
							JOIN linefollower ON category_tag.id_category_tag = linefollower.id_category_tag 
							WHERE category_tag.id_category = '".$cat_id[$j]."' AND category_tag.year = '".$_SESSION['year']."' ORDER BY linefollower.run_best ASC") or die(mysql_error());
				$k = 0;
				$tsme = 0;
				while ($robot = mysql_fetch_object($sql)) {
					$diq = 0;
					
					//echo "DONE";
					 //var_dump ($robot);
					if ($robot->show == 1){
						if ($robot->start_num != 0){
							
							//pripadne rovnakych casov c.1
							if ($runb == substr($robot->run_best, 3)) {
								if ($tsme == 0){
									$tsme = $k;
								}		
							} else {
								$tsme = 0;
							}
							$k++;
							$run1 = substr($robot->run_1, 3);
							$run2 = substr($robot->run_2, 3);
							$run3 = substr($robot->run_3, 3);
							$runb = substr($robot->run_best, 3);
							
							//pripad neplatnehu pokusu "--:--"
							if ($run1 == "59:59")  { $run1 = " &nbsp--:--&nbsp";}
							if ($run2 == "59:59")  { $run2 = " &nbsp--:--&nbsp";}
							if ($run3 == "59:59")  { $run3 = " &nbsp--:--&nbsp";}
							if ($runb == "59:59")  { $runb = " &nbsp--:--&nbsp";}
							
							if (($runb == " &nbsp--:--&nbsp") && ($disq == 0)){
								echo "<div style=\"width: 400px; text-align: center\"><hr width=\"50%\"></div>";
								$disq = 1;
							}
							
							//pripadne rovnakych casov c.2
							if ($tsme == 0){
								if ($runb == " &nbsp--:--&nbsp"){
									echo "&nbsp &nbsp &nbsp &nbsp &nbsp [$run1] [$run2] [$run3] ";
								}elseif ($run1 == $runb){
									echo "&nbsp &nbsp &nbsp".$k .".&nbsp <b>[$run1]</b> [$run2] [$run3] ";
								} elseif ($run2 == $runb){
									echo "&nbsp &nbsp &nbsp".$k.".&nbsp [$run1] <b>[$run2]</b> [$run3] ";
								} elseif ($run3 == $runb){
									echo "&nbsp &nbsp &nbsp".$k.".&nbsp [$run1] [$run2] <b>[$run3]</b> ";
								} 
							} else {
								if ($runb == " &nbsp--:--&nbsp"){
									echo "&nbsp &nbsp &nbsp &nbsp &nbsp [$run1] [$run2] [$run3] ";
								}elseif ($run1 == $runb){
									echo "&nbsp &nbsp &nbsp".$tsme .".&nbsp <b>[$run1]</b> [$run2] [$run3] ";
								} elseif ($run2 == $runb){
									echo "&nbsp &nbsp &nbsp".$tsme.".&nbsp [$run1] <b>[$run2]</b> [$run3] ";
								} elseif ($run3 == $runb){
									echo "&nbsp &nbsp &nbsp".$tsme.".&nbsp [$run1] [$run2] <b>[$run3]</b> ";
								}
							}	
							if (($runb == " &nbsp--:--&nbsp") && ($disq == 0)){
								echo "<div style=\"width: 400px; text-align: center\"><hr width=\"50%\"></div>";
								$disq = 1;
							}
							echo "&nbsp #".$robot->start_num."&nbsp <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.") ".$robot->town;
							
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
							if ($k == 3){
								echo "<div style=\"width: 400px; text-align: center\"><hr width=\"50%\"></div>";
							}
						}
					} 					
					
				}
				echo "<P>Pozn.: Časy sú v sekundách za jednotlivé pokusy, [ --:-- ] znamená, že robot dráhu neabsolvoval celú (viď pravidlá).</P>";	

	?>
        <P><B>Štatistika:</B> Do tejto kategórie sa prihlásilo spolu 36 robotov. 
        Súťaže sa zúčastnilo už len 27, pričom dráhu absolvovalo aspoň raz iba 
        15 robotov. V tomto roku ani jeden jediný robot nedokázal dráhu prejsť 
        vo všetkých troch  pokusoch. <BR>&nbsp; <BR>&nbsp; <BR>&nbsp; <P>
        <?
				
			//MYS V BLUDISKU
			$j=2;
				echo "<H3 id=\"".$cat_id[$j]."\">".$cat_name[$j]."</H3>";
                          ?>


                       <P>
                       <A HREF="./images/maze2013b.png"><IMG Src="./images/maze2013b.png" Align="right" Width=125 Height=125 Alt="[ Maze 2013 Final ]" Border=0></A>
                       <H3>Finále</H3>
                       <OL start="1">
                         <LI>[0:18] Robot #66 <A HREF="index.php?page=robotinfo&item=142"><B>Nite 3</B></A> (<I>Lukáš Pariža</I>) z   <IMG Alt="" Src="./images/FEIt.gif">
                         <LI>[0:23] Robot #63 <A HREF="index.php?page=robotinfo&item=218"><B>roXor</B></A> (<I>Ján Hudec</I>) z   <IMG Alt="" Src="./images/FEIt.gif">
                         <LI>[0:26] Robot #70 <A HREF="index.php?page=robotinfo&item=219"><B>Missile 3</B></A> (<I>Ján Hudec</I>) z   <IMG Alt="" Src="./images/FEIt.gif">
                         <HR Width=30%>
                         <LI>[0:38] Robot #76 <A HREF="index.php?page=robotinfo&item=146"><B>maroyaka</B></A> (<I>Miro Kalinovský</I>) z Bratislavy   <IMG Src="./images/Nula.gif">
                         <LI>[1:05] Robot #74 <A HREF="index.php?page=robotinfo&item=171"><B>Morqa</B></A> (<I>Andrej Lenčucha</I>) z FIIT STU   <IMG Alt="" Src="./images/Lego.gif">
                       </OL>

                     <P>
                   <A HREF="./images/maze2013a.png"><IMG Src="./images/maze2013a.png" Align="right" Width=125 Height=125 Alt="[ Maze 2013 ]" Border=0></A>
                  <H3>Qualification</H3>

			<?	
				// VYPIS ROBOTOV ID CATEGORY = 1
				$sql = mysql_query("SELECT category_tag.id_category, category_tag.start_num, author.name_surname, author.town, author.state, 
							robot.name, robot.show, robot.fei, robot.arduino, robot.lego, robot.id_robot, umouse.* FROM author 
							INNER JOIN robot ON author.id_author = robot.id_author 
							JOIN category_tag ON robot.id_robot = category_tag.id_robot 
							JOIN umouse ON category_tag.id_category_tag = umouse.id_category_tag 
							WHERE category_tag.id_category = '".$cat_id[$j]."' AND category_tag.year = '".$_SESSION['year']."' ORDER BY umouse.run_best_sc ASC") or die(mysql_error());
				$k = 0;
				$tsme = 0;
				while ($robot = mysql_fetch_object($sql)) {
					$diq = 0;
					
					//echo "DONE";
					 //var_dump ($robot);
					if ($robot->show == 1){
						if ($robot->start_num != 0){
							
							//pripadne rovnakych casov c.1
							if ($runb == substr($robot->run_best_sc, 3)) {
								if ($tsme == 0){
									$tsme = $k;
								}		
							} else {
								$tsme = 0;
							}
							$k++;
							$run1 = substr($robot->run_1_sc, 3);
							$run2 = substr($robot->run_2_sc, 3);
							$run3 = substr($robot->run_3_sc, 3);
							$runb = substr($robot->run_best_sc, 3);
							
							//pripad neplatnehu pokusu "--:--"
							if ($run1 == "59:59")  { $run1 = " &nbsp--:--&nbsp";}
							if ($run2 == "59:59")  { $run2 = " &nbsp--:--&nbsp";}
							if ($run3 == "59:59")  { $run3 = " &nbsp--:--&nbsp";}
							if ($runb == "59:59")  { $runb = " &nbsp--:--&nbsp";}
							
							if (($runb == " &nbsp--:--&nbsp") && ($disq == 0)){
								echo "<div style=\"width: 400px; text-align: center\"><hr width=\"50%\"></div>";
								$disq = 1;
							}
							
							//pripadne rovnakych casov c.2
							if ($tsme == 0){
								if ($runb == " &nbsp--:--&nbsp"){
									echo "&nbsp &nbsp &nbsp &nbsp &nbsp [$run1] [$run2] [$run3] ";
								}elseif ($run1 == $runb){
									echo "&nbsp &nbsp &nbsp".$k .".&nbsp <b>[$run1]</b> [$run2] [$run3] ";
								} elseif ($run2 == $runb){
									echo "&nbsp &nbsp &nbsp".$k.".&nbsp [$run1] <b>[$run2]</b> [$run3] ";
								} elseif ($run3 == $runb){
									echo "&nbsp &nbsp &nbsp".$k.".&nbsp [$run1] [$run2] <b>[$run3]</b> ";
								} 
							} else {
								if ($runb == " &nbsp--:--&nbsp"){
									echo "&nbsp &nbsp &nbsp &nbsp &nbsp [$run1] [$run2] [$run3] ";
								}elseif ($run1 == $runb){
									echo "&nbsp &nbsp &nbsp".$tsme .".&nbsp <b>[$run1]</b> [$run2] [$run3] ";
								} elseif ($run2 == $runb){
									echo "&nbsp &nbsp &nbsp".$tsme.".&nbsp [$run1] <b>[$run2]</b> [$run3] ";
								} elseif ($run3 == $runb){
									echo "&nbsp &nbsp &nbsp".$tsme.".&nbsp [$run1] [$run2] <b>[$run3]</b> ";
								}
							}	
							if (($runb == " &nbsp--:--&nbsp") && ($disq == 0)){
								echo "<div style=\"width: 400px; text-align: center\"><hr width=\"50%\"></div>";
								$disq = 1;
							}
							echo "&nbsp #".$robot->start_num."&nbsp <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.") ".$robot->town;
							
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
							if ($k == 3){
								echo "<div style=\"width: 400px; text-align: center\"><hr width=\"50%\"></div>";
							}
						}
					} 					
					
				}
				echo "<P>Uvedený je tzv. súťažný čas (viď <A href=\"index.php?page=rules&type=umouse\">pravidlá</A>)
						a číslo pokusu na ktorý bol dosiahnutý. Súťažný čas zahŕňa aj trestné
						sekundy za dotyky a zohľadňujú aj celkový čas v bludiskou od štartu.
					</P>";
			
         ?>
        <P><B>Štatistika:</B> Do tejto kategórie sa prihlásilo spolu 12 robotov. 
        Súťaže sa zúčastnilo už len 10, ale cestu bludiskom našlo rovnako ako vlani
        iba 9. Do finále postúpili 4 najlepší a 1 (Missile 3) dostal divokú 
        kartu. <BR>&nbsp; <BR>&nbsp; <BR>&nbsp; <P>
        <?
			
		//SKLAD KECUPOV
			$j=3;
			
			//pripad rovnakych casov c.1	
			$sum = 0;
			$tsme = 0;
				echo "<H3 id=\"".$cat_id[$j]."\">".$cat_name[$j]."</H3>";
				
				// VYPIS ROBOTOV ID CATEGORY = 1
							echo "<TABLE class=\"list3\">";
							$sql = mysql_query("SELECT robot.name, category_tag.start_num, category_tag.id_category_tag, SUM(ketchup.rank) AS value_sum FROM robot 
												INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot 
												JOIN ketchup on category_tag.id_category_tag = ketchup.id_category_tag
												WHERE category_tag.id_category = 3 AND category_tag.year = ".$_SESSION['year']."
												GROUP BY ketchup.id_category_tag
												ORDER BY  SUM(ketchup.rank) DESC") or die(mysql_error());
							$poc = mysql_num_rows($sql);
							
							echo "<TR><TH class=\"num\">č</TH><TD></TD>";
							for ($k = 1; $k <= $poc; $k++) {
								echo "<TD class=\"num\">".$k.".</TD>";	
							}
							echo "<TD class=\"num\"></TD></TR>";
							echo "<TR><TD class=\"num\"></TD><TH class=\"horizontal\"></TH>";
							while ($robot = mysql_fetch_object($sql)) {
								echo "<TH class=\"vertical\">".$robot->name."</TH>";
							}
							echo "<TH class=\"vertical\">SPOLU</TH></TR>";
							$sql2 = mysql_query("SELECT robot.name, category_tag.start_num, category_tag.id_category_tag, SUM(ketchup.rank) AS value_sum FROM robot 
												INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot 
												JOIN ketchup on category_tag.id_category_tag = ketchup.id_category_tag
												WHERE category_tag.id_category = 3 AND category_tag.year = ".$_SESSION['year']."
												GROUP BY ketchup.id_category_tag
												ORDER BY  SUM(ketchup.rank) DESC") or die(mysql_error());
							$poc = mysql_num_rows($sql);
							$i = 1;
							
							//set array of id_category_tag
							$l = 0;
							while ($robot = mysql_fetch_object($sql2)) {
								$opnt_id[$l] = $robot->id_category_tag;
								$l++;
							}
							
							$sql2 = mysql_query("SELECT robot.name, category_tag.start_num, category_tag.id_category_tag, SUM(ketchup.rank) AS value_sum FROM robot 
												INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot 
												JOIN ketchup on category_tag.id_category_tag = ketchup.id_category_tag
												WHERE category_tag.id_category = 3 AND category_tag.year = ".$_SESSION['year']."
												GROUP BY ketchup.id_category_tag
												ORDER BY  SUM(ketchup.rank) DESC") or die(mysql_error());
												
							while ($robot = mysql_fetch_object($sql2)) {
								
								//pripad rovnakych casov c.2
								$result = mysql_query("SELECT SUM(rank) AS value_sum FROM ketchup WHERE id_category_tag = ".$robot->id_category_tag);
								$row = mysql_fetch_assoc($result); 
								
								if ($sum == $row['value_sum']) {
									if ($tsme == 0){
										$tsme = $i-1;
									}		
								} else {
									$tsme = 0;
								}
								
								$sum = $row['value_sum'];
								if ($tsme == 0){
									echo "<TR><TD class=\"num\">".$i.".</TD><TH class=\"horizontal\">".$robot->name."</TH>";
								} else {
									echo "<TR><TD class=\"num\">".$tsme.".</TD><TH class=\"horizontal\">".$robot->name."</TH>";
								}
								
								// END pripad rovnakych casov 	
								
								$l = 0;
								for ($k = 1; $k <= $poc; $k++) {
									if ($k == $i){
										echo "<TD class=\"shadow\"></TD>";
									} else {
										$sql3 = mysql_query("SELECT rank FROM ketchup WHERE id_category_tag = ".$robot->id_category_tag." AND id_category_tag_opnt = ".$opnt_id[$l]) or die(mysql_error());
										if ($data = mysql_fetch_object($sql3)){
											$rank = $data->rank;
										} else {
											$rank = "";
										}		
										echo "<TD class=\"num\" style = \"text-align: center\">$rank</TD>";
									}
									$l++;	
								}
								echo "<TD class=\"sum\" style = \"text-align: center\"><b>$sum</b></TD></TR>";
								$i++;
							}
							echo "</TR></TABLE>";
		


	?>
        <P><B>Štatistika:</B> Do tejto kategórie sa prihlásilo menej robotov ako
        vlani, spolu 8. Súťaže sa zúčastnilo už len 6, pričom ani jeden 
        nefungoval celkom spoľahlivo. Okrem víťazných troch robotov žiaden 
        iný nedokázal získať ani jednu plechovku. <BR>&nbsp; <BR>&nbsp; <BR>&nbsp; <P>
        <?

		
		//VOLNA JAZDA
			$j=4;
				echo "<H3 id=\"".$cat_id[$j]."\">".$cat_name[$j]."</H3>";
				
				// VYPIS ROBOTOV ID CATEGORY = 1
				$sql = mysql_query("SELECT category_tag.id_category, category_tag.start_num, author.name_surname, author.town, author.state, 
							robot.name, robot.show, robot.fei, robot.arduino, robot.lego, robot.id_robot, freestyle.* FROM author 
								INNER JOIN robot ON author.id_author = robot.id_author 
								JOIN category_tag ON robot.id_robot = category_tag.id_robot 
								JOIN freestyle ON category_tag.id_category_tag = freestyle.id_category_tag 
								WHERE category_tag.id_category = '".$cat_id[$j]."' AND category_tag.year = '".$_SESSION['year']."' ORDER BY freestyle.total DESC") or die(mysql_error());
				$k = 0;
				$tsme = 0;
				while ($robot = mysql_fetch_object($sql)) {
					$diq = 0;
					
					//echo "DONE";
					 //var_dump ($robot);
					if ($robot->show == 1){
						if ($robot->start_num != 0){
							
							//pripadne rovnakych casov c.1
							if ($total == $robot->total) {
								if ($tsme == 0){
									$tsme = $k;
								}		
							} else {
								$tsme = 0;
							}
							$k++;
							$total = $robot->total;	
							
							//pripadne rovnakych casov c.2
							if ($tsme == 0){
								echo "&nbsp &nbsp &nbsp".$k .".&nbsp &nbsp Robot #".$robot->start_num."&nbsp (<b>".$robot->total."b</b>) <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.") ".$robot->town;
							} else {
								echo "&nbsp &nbsp &nbsp".$tsme .".&nbsp &nbsp Robot #".$robot->start_num."&nbsp (<b>".$robot->total."b</b>) <a href=\"index.php?page=robotinfo&item=".$robot->id_robot."\"><b>".$robot->name."</b></a> (".$robot->name_surname.") ".$robot->town;
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
						}
					} 					
					
				}
		?>

        <P><B>Štatistika:</B> Aj do tejto kategórie sa prihlásilo oveľa 
        menej robotov ako vlani, iba 8. Súťaže sa zúčastnilo už len 6, 
        pričom všetci prišli z Poľska. Víťazné poradie je stanovené na 
        základe hodnotenia šiestich porotcov. 
        <BR>&nbsp; <BR>&nbsp; <BR>&nbsp; <P>

		<H3 id="statistics">Štatistiky</H3>

		Napokon teda <b> súťažilo 

		
				 <?php
					//mozno preupravit podla zadanych sutazi pre dany rok, pre show = 0 nepocitat!
					$sql = mysql_query("SELECT COUNT(DISTINCT category_tag.id_robot ) FROM category_tag INNER JOIN robot ON category_tag.id_robot = robot.id_robot WHERE category_tag.year = '".$_SESSION['year']."' AND robot.show = 1");
					$sum = mysql_fetch_row($sql);
					echo $sum[0]." </b> robotov";
				 ?> 

		<UL>	 
			 <?php
				for ($j=1; $j<$i-1; $j++){
					echo "<LI>";
					$sql = mysql_query("SELECT COUNT(category_tag.id_robot) FROM category_tag INNER JOIN robot ON category_tag.id_robot = robot.id_robot WHERE category_tag.year = '".$_SESSION['year']."' AND robot.show = 1 AND id_category = '".$cat_id[$j]."'");
					$sum = mysql_fetch_row($sql);		 
					echo $sum[0]." ".$cat_name[$j]." </li>";
				}	
			?>
		</UL>

		
		Pripomienky a sťažnosti: <i> balogh slimacik elf.stuba.sk </i>
		<br>

	</DIV><!-- Content -->