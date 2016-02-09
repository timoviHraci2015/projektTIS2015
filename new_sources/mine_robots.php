	<div Id="content">
		<div style="text-align: center;">
				<i>&nbsp1. Registrácia účastníka ----> </i><b>2. Registrácia robota/robotov</b><i> ----> 3. Potvrdenie, koniec</i>
				<br/><br/>
		</div>
		<!-- javascript pre dynamicke menenie action pre formular -->
			<script type="text/javascript">
				function OnSubmitForm()
				{
				  if(document.pressed == 'Zmeň')
				  {
				   document.robot_data.action ="index.php?page=lor&catedit";
				  } else if(document.pressed == 'Edituj')
				  {
					document.robot_data.action ="index.php?page=login2";
				  } else if(document.pressed == 'Vymaž')
				  {
					document.robot_data.action ="index.php?page=lor&del";
				  } 
				  return true;
				}
			</script>		
			
			<?php
				if (empty($_SESSION['a_id'])){
					$wim = 0; //Where I'M??
				} else{
					$wim = 1;
				}	//0 - klaska, 1-logged
				
				//ked sa vratim z "EDIT" -> uvolnenie $_SESSION['r_id']!
				if(isset($_SESSION['r_id'])){
					$_SESSION['r_id'] = "";
				}	
			////PRIPAD DELETE-----> SHOW = 0; year = 0;			
				if (isset($_POST['delete']) && !empty($_POST['r_id'])){
						//echo "DELETE PRE ID".$_POST['r_id'];
						openMySQL($host, $user, $passwd, $db);
						//"vymazanie" robota
						mysql_query("UPDATE robot SET `show` = 0 WHERE id_robot = ".$_POST['r_id']) or die("Error fadeing ROBOT: ".mysql_error()."");
						//"vymazanie" priradenych kategorii robota
						mysql_query("DELETE FROM competitions_contestants WHERE robot_id = '".$_POST['r_id']."'") or die("Error fadeing CompetitionsContestants: ".mysql_error()."");
						@sendmailAdminDel($_SESSION['a_id'],$_POST['r_id']);
			
			////EDIT -> presun na "prihlaska_robot.php"
				} elseif (isset($_POST['edit']) && !empty($_POST['r_id'])){
						$_SESSION['r_id'] = $_POST['r_id'];
						redir("index.php?page=login2");	
					
			////REGISTRATION TO COMPETTION YEAR = $_SESSION['year']
				} elseif (isset($_POST['catedit']) && !empty($_POST['r_id'])){
						//echo "CHANGE CATEGORY PRE ID->".$_POST['r_id'];
				
						//uprava competitions_contestants
						$sql = mysql_query("select * from competitions where year='".CompetitionYear::getCurrentYear()."'");
						while ($competition = mysql_fetch_object($sql)) {
						$duplic = false;
							if (!empty($_POST['check_list'])){
								foreach($_POST['check_list'] as $check) {
									if ($check == $competition->id){
										$duplic = true;
										$sql2 = mysql_query("select * from competitions_contestants where competition_id = '".$check."' and robot_id ='".$_POST['r_id']."'") or die("Error selecting CompetitionsContestants: ".mysql_error());
										if (mysql_num_rows($sql2) == 0){
											//echo " taguje! ";	
											//echo "ROK:".$_SESSION['year'];
											//echo "INSERT ";
											mysql_query("insert into competitions_contestants (competition_id, robot_id) values ('".$check."','".$_POST['r_id']."')") or die("Error editing CompetitionsContestants: ".mysql_error()."");
										}
											
									}
										
						
								}
							}
							if ($duplic == false){
								//echo "DELETE ";
								mysql_query("delete from competitions_contestants where competition_id = '".$competition->id."' and robot_id ='".$_POST['r_id']."'") or die("Error editing CompetitionsContestants: ".mysql_error()."");
							}
							
				
						}	
			
				}
				
			////END VELKYCH IF-ov
				
				if ($wim == 1){
					echo "<H2>Moje roboty</h2>"; 
					//echo "<TR><TD class=\"title\">Zoznam robotov:</TD></TR>";
					//vyhladanie vsetkych robotov autora
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("select * from robot where `show` = 1 and id_author ='".$_SESSION['a_id']."'") or die(mysql_error());
					//$robot = mysql_fetch_object($sql);
					while ($robot = mysql_fetch_object($sql)) {
						//echo "<option value=\"".$robot->id_robot."&".$robot->name."\">".$robot->name."</option>";
						echo "<TR><TD class=\"title\"></TD><TD><FORM name=\"myform\" Method=\"POST\"><TABLE class=\"form\"><TR>";
						echo "<TD><INPUT Type=\"text\" display=\"inline\" disabled=\"disabled\" Name=\"r_name\" value=\"".$robot->name."\" Size=\"30\"></TD>";
						echo "<TD><INPUT Type=\"submit\" display=\"inline\" Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Edituj\"></TD>";
						echo "<TD><INPUT Type=\"submit\" display=\"inline\" Name=\"delete\" onclick=\"document.pressed=this.value\" value=\"Vymaž\"></TD>";
						echo "<TD><INPUT Type=\"hidden\" display=\"inline\" Name=\"r_id\" value=\"".$robot->id_robot."\" Size=\"30\"></TD></TR><TR><TD>";
				
					//vypis sutazi vsetkych sutazi, kde sa robot zucastnil - bez jednotlivych kategorii, netreba!
						$duplicity_text = 0;
						$sql3 = mysql_query("SELECT * FROM competitions INNER JOIN competitions_contestants ON competitions.id = competitions_contestants.competition_id WHERE competitions.year <> '".$_SESSION['year']."' AND competitions_contestants.robot_id = ".$robot->id_robot) or die(mysql_error());
						while ($tag = mysql_fetch_object($sql3)) {
								if ($duplicity_text == 0){
									echo "<i>Účastník Istrobot ";
									$duplicity_text = 1;
									echo $tag->year;
								} else{
									echo ", ".$tag->year;
								}
						}
						echo "</i></TD></TR><TR><TD>";
						
					//vypis kategorii aktualnej sutaze, ktorej sa chce robot zucastni
						echo "<b>Súťažná kategória pre rok ".$_SESSION['year'].":</b></TD><TD colspan=\"2\" class=\"notice\"> ● Povinný údaj</TD></TR><TR><TD><UL>";
							$sql3 = mysql_query("select * from competitions where year=".$_SESSION['year']);
								while ($competition = mysql_fetch_object($sql3)) {
									$isCompetitionOpen = time() - strtotime($competition->sign_in_deadline) < 0;
									$disabled = "";
									if(!$isCompetitionOpen) {
										$disabled = "disabled='disabled'";
									}
									
									$sql2 = mysql_query("select * from competitions_contestants INNER JOIN competitions ON competitions.id = competitions_contestants.competition_id	 WHERE competition_id = '".$competition->id."' and robot_id = '".$robot->id_robot."' AND (competitions.year = 0 OR competitions.year = '".$_SESSION['year']."')") or die(mysql_error());
									if (mysql_num_rows($sql2) != 0){
										echo "<li><input type=\"checkbox\" Name=\"check_list[]\" checked=\"checked\" ".$disabled." value=\"".$competition->id."\">".$competition->name." ( Deadline: ".$competition->sign_in_deadline." ) </li>";
									} else { 
										echo "<li><input type=\"checkbox\" Name=\"check_list[]\" ".$disabled." value=\"".$competition->id."\">".$competition->name." ( Deadline: ".$competition->sign_in_deadline." ) </li>";
									}
								}
						echo "</UL>";
				

						echo "</TD><TD><br/><br/><br/><br/><br/><INPUT Type=\"submit\" display=\"inline\" Name=\"catedit\" onclick=\"document.pressed=this.value\" value=\"Zmeň\"></TD></TR>";
						echo "<TR><TD colspan=\"3\" style=\"width: 360px\"><hr></TD></TR>";
						echo "</TABLE></FORM></TD></TR>";
					}
					//echo "</TR>";
					echo "<TABLE class=\"form\">";
					echo "<TR><TD class=\"input\"><FORM name=\"add\" action=\"index.php?page=login2&action=new\" Method=\"POST\">";		
					echo "<INPUT Type=\"submit\" name=\"pridaj\" value=\"Pridaj nového robota\"></FORM></TD></TR>";
					echo "<TR><TD style=\"width: 360px\"><hr></TD></TR>";
					
					echo "<TR><TD style=\"width: 360px; text-align:center;\"><FORM name=\"toConfirm\" action=\"index.php?page=confirm\" Method=\"POST\">";	
					echo "<INPUT Type=\"submit\" name=\"logged\" value=\"Hotovo\"></TD></TR>";
					echo "</TABLE>";
					//echo "<TD class=\"input\"><INPUT Type=\"submit\"  Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Edituj\">";
					//echo "<INPUT Type=\"submit\"  Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Vymaž\"></TD></TR>";
					//echo "<TR><TD class=\"title\"></TD><TD class=\"input\"><INPUT Type=\"text\" Name=\"r_name2\" value=\"".$r_name2."\" Size=\"30\"></TD>";
					//echo "<TD class=\"input\"><INPUT Type=\"submit\"  Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Pridaj\"></TD></TR>"; 
				}
			?>
	</div>