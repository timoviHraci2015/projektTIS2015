 <?php
		//session_start();
		$cryptinstall="captcha/cryptographp.fct.php";
		include $cryptinstall;
		if (empty($_SESSION['a_id'])){
			$wim = 0; //Where I'M??
		} else{
			$wim = 1;
		}	//0 - klaska, 1-logged
		$r_name_disable =  "disabled=\"disabled\"";
		
		//pripade prechodu noveho uzivatela na udaje robota:
		if (isset($_SESSION['subnamesc'])){
			$subnames = $_SESSION['subnames'];
		}

		//echo "<br/> $_SESSION ['author']".$_SESSION['author'];
		//echo "<br/> $_SESSION ['a_id']".$_SESSION['a_id'];
		//echo "<br/> $_SESSION ['robot_id']".$_SESSION['robot_id'];
		//echo "<br/> $_GET ['action']".$_GET['action'];
		
		// INSERT PRE NOVEHO UZIVATELA + show = 0
		if (!empty($_SESSION['author']) && empty($_SESSION['a_id']) && ($_GET['action']=="inserted")  && empty($_SESSION['robot_id'])) {
		//echo "INSERT PRE NOVEHO UZIVATELA";
			$wim = 0;
			if (!empty($_POST['cpu']) && !empty($_POST['prog_lang']) && !empty($_POST['rname']) && !empty($_POST['check_list'])){
				//nulovanie premennych
					$rname = ""; 
					$cpu = "";
					$ram = "";
					$freq = "";
					$sensors = "";
					$drive = "";
					$power = "";
					$prog_lang = "";
					$misc = "";
					$web = "";
					$descript = "";
				
				//novy zapis do premennych
					$rname = $_POST['rname'];
					$subnames = $_POST['subnames'];
					$cpu = $_POST['cpu'];
					$ram = $_POST['ram'];
					$freq = $_POST['freq'];
					$sensors = $_POST['sensors'];
					$drive = $_POST['drive'];
					$power = $_POST['power'];
					$prog_lang = $_POST['prog_lang'];
					$misc = $_POST['misc'];
					
					//edit kontrola zadania "http://"					
					$web = $_POST['web'];
					if ((substr($web,0,7) != "http://") && ($web != "")) {
						$web = "http://".$web;
					}
					
					$descript = $_POST['descript'];
		
					openMySQL($host, $user, $passwd, $db);
					mysql_query("insert into robot values ('','".$_SESSION['author_id']."','".$_POST['subnames']."','".$_POST['rname']."','".$_POST['cpu']."','".$_POST['ram']."','".$_POST['freq']."','".$_POST['sensors']."','".$_POST['drive']."','".$_POST['power']."','".$_POST['prog_lang']."','".$_POST['misc']."','".$web."','".$_POST['descript']."',1,0,0,0)") or die("Error adding ROBOT: ".mysql_error()."");
					$_SESSION['robot_id'] =  mysql_insert_id();
				
					///zapis kategorii robota -> neupotvrdena (preto year = 0)!
						foreach($_POST['check_list'] as $categ) {	
							mysql_query("insert into competitions_contestants (competition_id, robot_id) values ('".$categ."','".$_SESSION['robot_id']."')") or die("Error adding competitions_contestants: ".mysql_error()."");
						}
					$_SESSION['categ_list'] = $_POST['check_list'];
					
					redir("index.php?page=confirm&new");	
		////PRIPAD ZLE VYPLNENYCH INPUTOV (RNAME+CPU+PROG_LANG)					
				} else{
					//echo " && KEY FAILED";
					if (empty($_POST['cpu'])){
						$err_cpu = "class = \"err_input\"";
						$cpu = "";
					} else{
						$err_cpu = "";
						$cpu = $_POST['cpu'];
					}
					
					if (empty($_POST['prog_lang'])){
						$err_lang = "class = \"err_input\"";
						$prog_lang = "";
					} else{
						$err_lang = "";
						$prog_lang = $_POST['prog_lang'];
					}
					
					if (empty($_POST['rname'])){
						$err_rname = "class = \"err_input\"";
						$rname = "";
					} else{
						$err_rname = "";
						$rname = $_POST['rname'];
					}

					$ram = $_POST['ram'];
					$subnames = $_POST['subnames'];
					$freq = $_POST['freq'];
					$sensors = $_POST['sensors'];
					$drive = $_POST['drive'];
					$power = $_POST['power'];
					$misc = $_POST['misc'];
					//edit kontrola zadania "http://"					
					$web = $_POST['web'];
					if ((substr($web,0,7) != "http://") && ($web != "")) {
						$web = "http://".$web;
					}
					$descript = $_POST['descript'];
					
				}
				
		//// VYPIS PRE NEW PRE UPDATE -> vratil sa z "CONFIRM"	
			} elseif (!empty($_SESSION['robot_id']) && isset($_GET['renew']) && !empty($_SESSION['robot_id']))  {
					
					//echo "VYPIS PRE NEW USER PRE UPDATE";
					//ziskanie udajov robota (podla mena a nie ID!, !!!osefovat duplicity pri reg)
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("select * from robot where id_robot = '".$_SESSION['robot_id']."'") or die(mysql_error());
					while ($robot = mysql_fetch_object($sql)) {
						//novy zapis do premennych z DB
							$rname = $robot->name;
							$subnames = $robot->subauthor;
							$cpu = $robot->procesor;
							$ram = $robot->memory;
							$freq = $robot->frequency;
							$sensors = $robot->sensors;
							$drive = $robot->drive;
							$power = $robot->power_supply;
							$prog_lang = $robot->prog_language;
							$misc = $robot->interestings;
							$web = $robot->web;
							$descript = $robot->description;
						
					}
		////UPRAVA PRE NEW USER -> vratil sa z "CONFIRM"			
			} elseif (!empty($_SESSION['robot_id']) && ($_GET['action'] == "inserted") && empty($_SESSION['newlog'])) {
					
					//echo "UPRAVA PRE NEW USER";
					//echo "ID ->".$_SESSION['robot_id'];
					$wim = 0;
					$duplic = false;
					
					//echo "UPRAVA";
					openMySQL($host, $user, $passwd, $db);
					
					//edit kontrola zadania "http://"					
					$web = $_POST['web'];
					if ((substr($web,0,7) != "http://") && ($web != "")) {
						$web = "http://".$web;
					}
					
					//uprava ROBOT
					mysql_query("update robot set subauthor = '".$_POST['subnames']."', name = '".$_POST['rname']."', procesor ='".$_POST['cpu']."', memory ='".$_POST['ram']."', frequency ='".$_POST['freq']."', sensors ='".$_POST['sensors']."', drive ='".$_POST['drive']."', power_supply ='".$_POST['power']."', prog_language ='".$_POST['prog_lang']."', interestings ='".$_POST['misc']."', web ='".$web."', description ='".$_POST['descript']."' where id_robot ='".$_SESSION['robot_id']."'") or die("Error editing ROBOT: ".mysql_error()."");
					
					//uprava CATEGORY_TAG
					$sql = mysql_query("select * from competitions where year=".$_SESSION['year']);
					while ($competition = mysql_fetch_object($sql)) {
					$duplic = false;
					//echo var_dump($_POST['check_list']);
						if (!empty($_POST['check_list'])){
							foreach($_POST['check_list'] as $check) {
								if ($check == $competition->id){
									$duplic = true;
									$sql2 = mysql_query("select * from competitions_contestants where competition_id = '".$check."' and robot_id ='".$_SESSION['robot_id']."'") or die("Error selecting CATEGORY_TAG: ".mysql_error());
									if (mysql_num_rows($sql2) == 0){
										//echo " taguje! ";	
										//echo "ROK:".$_SESSION['year'];
										//echo "INSERT ";
										mysql_query("insert into competitions_contestants (competition_id, robot_id) values ('".$check."','".$_SESSION['robot_id']."')") or die("Error editing CATEGORY_TAG: ".mysql_error()."");
									}
										
								}
									
					
							}
						}
						if ($duplic == false){
							//echo "DELETE ";
							mysql_query("delete from competitions_contestants where competition_id = '".$competition->id."' and robot_id ='".$_SESSION['robot_id']."'") or die("Error editing CATEGORY_TAG: ".mysql_error()."");
						}
						
			
					}
				//novy zapis do premennych
					$rname = $_POST['rname'];
					$subnames = $_POST['subnames'];
					$cpu = $_POST['cpu'];
					$ram = $_POST['ram'];
					$freq = $_POST['freq'];
					$sensors = $_POST['sensors'];
					$drive = $_POST['drive'];
					$power = $_POST['power'];
					$prog_lang = $_POST['prog_lang'];
					$misc = $_POST['misc'];
					//edit kontrola zadania "http://"					
					$web = $_POST['web'];
					if ((substr($web,0,7) != "http://") && ($web != "")) {
						$web = "http://".$web;
					}
					$descript = $_POST['descript'];
				
				$_SESSION['categ_list'] = $_POST['check_list'];
				redir("index.php?page=confirm&new");		
					
			
		//// VYPIS KED SOM PRIHLASENY PRE UPDATE			
			} elseif (!empty($_SESSION['a_id']) && !isset($_GET['action']) && !empty($_SESSION['r_id']))  {
				//echo "VYPIS KED SOM PRIHLASENY PRE UPDATE";
				$_SESSION['newlog'] = "";
				$wim = 1;		

					//echo "ID ROBOTA:-> ".$_SESSION['r_id'];

					
					//ziskanie udajov robota (podla mena a nie ID!, !!!osefovat duplicity pri reg)
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("select * from robot where id_robot = '".$_SESSION['r_id']."'") or die(mysql_error());
					while ($robot = mysql_fetch_object($sql)) {
						//novy zapis do premennych z DB
							$rname = $robot->name;
							$subnames = $robot->subauthor;
							$cpu = $robot->procesor;
							$ram = $robot->memory;
							$freq = $robot->frequency;
							$sensors = $robot->sensors;
							$drive = $robot->drive;
							$power = $robot->power_supply;
							$prog_lang = $robot->prog_language;
							$misc = $robot->interestings;
							$web = $robot->web;
							$descript = $robot->description;
						
					}
					
		////UPRAVA KED SOM PRIHLASENY		
			} elseif (!empty($_SESSION['a_id']) && ($_GET['action'] == "updated") && !empty($_SESSION['r_id'])) {
				//echo "UPRAVA KED SOM PRIHLASENY";
				//echo "ID ->".$_SESSION['r_id'];
				$wim = 1;
				$duplic = false;
				
				//echo "UPRAVA";
				openMySQL($host, $user, $passwd, $db);
				
				//edit kontrola zadania "http://"					
					$web = $_POST['web'];
					if ((substr($web,0,7) != "http://") && ($web != "")) {
						$web = "http://".$web;
					}
					
				//uprava ROBOT
				mysql_query("update robot set subauthor = '".$_POST['subnames']."', name = '".$_POST['rname']."', procesor ='".$_POST['cpu']."', memory ='".$_POST['ram']."', frequency ='".$_POST['freq']."', sensors ='".$_POST['sensors']."', drive ='".$_POST['drive']."', power_supply ='".$_POST['power']."', prog_language ='".$_POST['prog_lang']."', interestings ='".$_POST['misc']."', web ='".$web."', description ='".$_POST['descript']."' where id_robot ='".$_SESSION['r_id']."'") or die("Error editing ROBOT: ".mysql_error()."");
				
				//uprava CATEGORY_TAG
				$sql = mysql_query("select * from competitions");
				while ($competition = mysql_fetch_object($sql)) {
				$duplic = false;
				//echo var_dump($_POST['check_list']);
					if (!empty($_POST['check_list'])){
						foreach($_POST['check_list'] as $check) {
							if ($check == $competition->id){
								$duplic = true;
								$sql2 = mysql_query("select * from competitions_contestants where competition_id = '".$check."' and robot_id ='".$_SESSION['r_id']."'") or die("Error selecting CATEGORY_TAG: ".mysql_error());
								if (mysql_num_rows($sql2) == 0){
									//echo " taguje! ";	
									//echo "ROK:".$_SESSION['year'];
									//echo "INSERT ";
									mysql_query("insert into competitions_contestants (competition_id, robot_id) values ('".$check."','".$_SESSION['r_id']."')") or die("Error editing CATEGORY_TAG: ".mysql_error()."");
								}
									
							}
								
				
						}
					}
					if ($duplic == false){
						//echo "DELETE ";
						mysql_query("delete from competitions_contestants where competition_id = '".$competition->id."' and robot_id ='".$_SESSION['r_id']."'") or die("Error editing CATEGORY_TAG: ".mysql_error()."");
					}
					
		
				}
			//novy zapis do premennych
				$rname = $_POST['rname'];
				$subnames = $_POST['subnames'];
				$cpu = $_POST['cpu'];
				$ram = $_POST['ram'];
				$freq = $_POST['freq'];
				$sensors = $_POST['sensors'];
				$drive = $_POST['drive'];
				$power = $_POST['power'];
				$prog_lang = $_POST['prog_lang'];
				$misc = $_POST['misc'];
				//edit kontrola zadania "http://"					
				$web = $_POST['web'];
				if ((substr($web,0,7) != "http://") && ($web != "")) {
					$web = "http://".$web;
				}
				$descript = $_POST['descript'];
				
		////VYPIS KED SOM PRIHLASENY ALE NEZADANY NAZOV ROBOTA LOL :D	
			//} elseif (!empty($_SESSION['a_id']) && empty($_POST['r_name2']) && ($_GET['action'] == "new") && empty($_SESSION['newlog'])) {
			//	redir("index.php?page=login&action=error");
				
		////VYPIS KED SOM PRIHLASENY PRE INSERT	
			} elseif (!empty($_SESSION['a_id']) && ($_GET['action'] == "new")) {
				//echo "VYPIS KED SOM PRIHLASENY PRE INSERT";
				$wim = 1;
				$_SESSION['r_id'] = "";
				$rname = $_POST['rname'];
				$_SESSION['newlog'] = "newlog";
				//echo $_SESSION['newlog'];
				$r_name_disable = "";

		//INSERT KED SOM PRIHLASENY PRE INSERT + skow = 1			
			} elseif (!empty($_SESSION['a_id']) && $_GET['action']=="inserted" && !empty($_SESSION['newlog'])) {
				//echo "INSERT KED SOM PRIHLASENY PRE INSERT";
				$wim = 1;
				$r_name_disable = "";
				
			//novy zapis do premennych
				$rname = $_POST['rname'];
				$subnames = $_POST['subnames'];
				$cpu = $_POST['cpu'];
				$ram = $_POST['ram'];
				$freq = $_POST['freq'];
				$sensors = $_POST['sensors'];
				$drive = $_POST['drive'];
				$power = $_POST['power'];
				$prog_lang = $_POST['prog_lang'];
				$misc = $_POST['misc'];
				//edit kontrola zadania "http://"					
				$web = $_POST['web'];
				if ((substr($web,0,7) != "http://") && ($web != "")) {
					$web = "http://".$web;
				}
				$descript = $_POST['descript'];
				
				openMySQL($host, $user, $passwd, $db);
				mysql_query("insert into robot values ('','".$_SESSION['a_id']."','".$_POST['subnames']."','".$_POST['rname']."','".$_POST['cpu']."','".$_POST['ram']."','".$_POST['freq']."','".$_POST['sensors']."','".$_POST['drive']."','".$_POST['power']."','".$_POST['prog_lang']."','".$_POST['misc']."','".$web."','".$_POST['descript']."',1,0,0,0)") or die("Error adding ROBOT of Logged user: ".mysql_error()."");
				$_SESSION['robot_id'] =  mysql_insert_id();
				
				if(!empty($_POST['check_list'])) {
					foreach($_POST['check_list'] as $categ) {	
						mysql_query("insert into competitions_contestants (competition_id, robot_id) values ('".$categ."','".$_SESSION['robot_id']."')") or die("Error adding CATEGORY_TAG of ROBOT of Logged user: : ".mysql_error()."");
					}
				}
				//nulovanie $_SESSION napomocnych pre insert pre logged usera
				$_SESSION['newlog'] = "";
				
				redir("index.php?page=lor");	
				
				
			}
	
	
?>
		 <div Id="content">
			<div style="text-align: center;">
				<i>&nbsp1. Registrácia účastníka ----> </i><b>2. Registrácia robota/robotov</b><i> ----> 3. Potvrdenie, koniec</i>
				<br/><br/>
			</div>
			<H2>Robot</h2>


			<!-- javascript pre dynamicke menenie action pre formular -->
			<script type="text/javascript">
				function OnSubmitForm()
				{
				  if(document.pressed == 'Uprav')
				  {
				   document.robot_data.action ="index.php?page=login2&action=updated";
				  } else if(document.pressed == 'OK' || document.pressed == 'Hotovo')
				  {
					document.robot_data.action ="index.php?page=login2&action=inserted";
				  } else if(document.pressed == 'Hotovo ')
				  {
					document.robot_data.action ="index.php?page=lor";
				  } 
				  return true;
				}
			</script>		
			<FORM name="robot_data" onsubmit="return OnSubmitForm();" Method="POST">
				<TABLE class="form"> 
						<TR><TD><b>Hlavný koštruktér:</b></td><td><INPUT Type="text" Name="aname" Size="30" disabled="disabled" Value="<?php echo $_SESSION['author']?>"></td></tr>
						<TR><TD><b>Spoluautori:</b></td><td><INPUT Type="text" Name="subnames" Size="30" Value="<?php echo $subnames ?>"></td></tr>
				</TABLE>
				<TABLE class="form">
					<?php
						echo "<i><br/>Jedného robota môžete prihlásiť aj do viacerých kategórií naraz</i>";

						//UPRAVA PRE LOGGED $wim = 1
						if ($wim == 1){
							echo "<UL>";
							$sql3 = mysql_query("select * from competitions where year='".CompetitionYear::getCurrentYear()."'");
								while ($competition = mysql_fetch_object($sql3)) {
									$isCompetitionOpen = time() - strtotime($competition->sign_in_deadline) < 0;
									$disabled = "";
									if(!$isCompetitionOpen) {
										$disabled = "disabled='disabled'";
									}

									$sql2 = mysql_query("select * from competitions_contestants JOIN competitions ON competitions.id = competitions_contestants.competition_id where competition_id = '".$competition->id."' and robot_id = '".$_SESSION['r_id']."' AND (competitions.year = 0 OR competitions.year = '".CompetitionYear::getCurrentYear()."')") or die(mysql_error());
									if (mysql_num_rows($sql2) != 0){
										echo "<li>
												<input type=\"checkbox\" Name=\"check_list[]\" checked=\"checked\" value=\"".$competition->id."\" ".$disabled.">"
												.$competition->name.
												" ( Deadline: ".$competition->sign_in_deadline." ) 
											 </li>";
									} else { 
										echo "<li>
												<input type=\"checkbox\" Name=\"check_list[]\" value=\"".$competition->id."\" ".$disabled.">"
												.$competition->name.
												" ( Deadline: ".$competition->sign_in_deadline." ) 
											  </li>";
									}
								}
							echo "</UL>";
						//UPRAVA PRE NEW $wim = 0			
						} else {
							echo "<UL>";
							openMySQL($host, $user, $passwd, $db);
							$sql = mysql_query("select * from competitions where year='".CompetitionYear::getCurrentYear()."'");
							if (empty($_POST['check_list']) && empty($_SESSION['categ_list'])) {
								while ($competition = mysql_fetch_object($sql)) {
									$isCompetitionOpen = time() - strtotime($competition->sign_in_deadline) < 0;
									$disabled = "";
									if(!$isCompetitionOpen) {
										$disabled = "disabled='disabled'";
									}

									echo "<li><input type=\"checkbox\" Name=\"check_list[]\" value=\"".$competition->id."\" ".$disabled.">"
											.$competition->name." ( Deadline: ".$competition->sign_in_deadline." ) 
										  </li>";
								}
							
							} else {
								while ($competition = mysql_fetch_object($sql)) {
									$duplic = false;
									/// if - kontrola naplnenia POSTU pre edit new usera -> taham zo session
									if(empty($_POST['check_list']) && isset($_SESSION['categ_list'])) {
										$_POST['check_list'] = $_SESSION['categ_list'];
									}

									$isCompetitionOpen = time() - strtotime($competition->sign_in_deadline) < 0;
									$disabled = "";
									if(!$isCompetitionOpen) {
										$disabled = "disabled='disabled'";
									}

									/// if - kontrola naplnenia POSTU pre pripad vratenia sa na podstranku - tzv backspace :D
									if(!empty($_POST['check_list'])) {
									
										foreach($_POST['check_list'] as $check) {	
											if ($check == $competition->id){
												echo "<li><input type=\"checkbox\" Name=\"check_list[]\" checked=\"checked\" ".$disabled." value=\"".$competition->id."\">".$competition->name." ( Deadline: ".$competition->sign_in_deadline." ) </li>";
												$duplic = true;
											} 										
										}
										echo ($duplic == false) ? "<li><input type=\"checkbox\" Name=\"check_list[]\" ".$disabled." value=\"".$competition->id."\">".$competition->name." ( Deadline: ".$competition->sign_in_deadline." ) </li>" : "";
									
									} else {
										echo ($duplic == false) ? "<li><input type=\"checkbox\" Name=\"check_list[]\" ".$disabled." value=\"".$competition->id."\">".$competition->name." ( Deadline: ".$competition->sign_in_deadline." ) </li>" : "";
									}
								}	
							}
							echo "</UL>";	
						
						}
					?>
									
				
					<TR><TD colspan = "4"><span id="robot_data_text" class="nadpis">Základné údaje</span></br></TD></TR>
					<TR><TD class="reddot"></TD><TD class="title">Názov:	</TD><TD>  <INPUT <?php echo $err_rname?> onclick="this.value=''" Type="text" Name="rname" Size="30" value="<?php echo $rname; ?>"> </TD><TD class="notice"> ● </TD></TR>
					<TR><TD class="reddot"></TD><TD class="title">Procesor:		</TD><TD>  <INPUT <?php echo $err_cpu?> onclick="this.value=''" Type="text" Name="cpu" Size="30" value="<?php echo $cpu; ?>">  </TD><TD class="notice"> ● </TD></TR>
					<TR><TD></TD><TD class="title">Veľkosť pamäte:    </TD><TD>     <INPUT Type="text" Name="ram" Size="30" value="<?php echo $ram; ?>">    </TD></TR>
					<TR><TD></TD><TD class="title">Frekvencia:        </TD><TD>     <INPUT Type="text" Name="freq" Size="30" value="<?php echo $freq; ?>"><BR> </TD></TR>
					<br/>
					<TR><TD></TD><TD class="title">Senzory:           </TD><TD>     <INPUT Type="text" Name="sensors" Size="30" value="<?php echo $sensors; ?>">   </TD></TR>
					<TR><TD></TD><TD class="title">Pohon:             </TD><TD>     <INPUT Type="text" Name="drive" Size="30" value="<?php echo $drive; ?>">     </TD></TR>
					<TR><TD></TD><TD class="title">Napájanie:         </TD><TD>     <INPUT Type="text" Name="power" Size="30" value="<?php echo $power; ?>">     </TD></TR>
					<br/>
					<TR><TD class="reddot"></TD><TD class="title">Programovací jazyk:</TD><TD>     <INPUT <?php echo $err_lang?> onclick="this.value=''" Type="text" Name="prog_lang" Size="30" value="<?php echo $prog_lang; ?>">  </TD><TD class="notice"> ● </TD></TR>
					<TR><TD></TD><TD class="title">Zaujímavosti:      </TD><TD>     <INPUT Type="text" Name="misc" Size="30" value="<?php echo $misc; ?>">      </TD></TR>
					<TR></TR>
					<TR><TD></TD><TD class="title">Domáca stránka robota:</TD><TD><INPUT Type="text" Name="web" Size="30" value="<?php echo $web; ?>"></TD></TR>
					<tr><TD></TD><td class="title">Popis:</td><td><TEXTAREA Name="descript" Rows=5 Cols=24><?php echo $descript; ?></TEXTAREA>
				<?php
					if (($wim == 0) || ($_SESSION['newlog'] == "newlog")){
						echo "</td><td><br/><br/><br/><br/>&nbsp&nbsp<INPUT Type=\"reset\" Value=\"Vymazať\">";
						echo "</td></tr>";
						echo "<TR><TD></TD><td class=\"title\"></td><TD><br/><INPUT style=\"width: 150px\" Type=\"submit\" onclick=\"document.pressed=this.value\" Value=\"Hotovo\"></TR>";
						//echo "<INPUT Type=\"submit\" onclick=\"document.pressed=this.value\" Value=\"OK\"></td></tr>";
					} else {
						echo "<INPUT Type=\"submit\" onclick=\"document.pressed=this.value\" Value=\"Uprav\">";
						echo "<TR><TD></TD><td class=\"title\"></td><TD><br/><INPUT style=\"width: 150px\" Type=\"submit\" onclick=\"document.pressed=this.value\" Value=\"Hotovo \"></TR>";
					}
				?>
					
				</TABLE>									
			</FORM>
		</div>