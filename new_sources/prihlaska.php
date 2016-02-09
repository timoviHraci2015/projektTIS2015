 <?php
		//session_start();
		$cryptinstall="captcha/cryptographp.fct.php";
		include $cryptinstall;
		$_SESSION['robot_id'] = "";
		//nulovanie premennych
				$wim = 0; //0 - klaska, 1-logged
				$mail_atrib = ""; //disable mail if logged
				$a_name = "";
				//$r_name = "";
				//$r_name2 = "";
				$age = "";
				$job = "";
				$mail = $_POST['login'];
				//$category = "";
				$address = "";
				$pasw = "";
				$pasw2 = "";
				$checkbox = "";
				//definicia (nulovanie) pola pre $control
				$key = array();
				for($i=0;$i<8;$i++){
					$key[$i]="";
				}
		//PRECHOD Z PRIHLASIT SA -> ?new=email
		if (isset($_GET['new'])){	
			$_SESSION['mail'] = $_GET['new'];
			}
			
		//RESGISTRACIA NOVEHO UZIVATELA		
		if (isset($_GET['key']) && empty($_SESSION['a_id'])) {
			//echo "REG NEW USER";
			openMySQL($host, $user, $passwd, $db);	
			//kontrola dat z prihlaska.php A_name+R_name+Check_list+Address+Mail+Code+Pasw_compare
			$control = "";
			!empty($_POST['a_name'])? $control = $control."1": $control = $control."0";
			isnum_age($_POST['age'])? $control = $control."1": $control = $control."0";	
			$control = $control."1"; //!empty($_POST['address'])? $control = $control."1": $control = $control."0"; -> kontakt nieje povinny
			//!empty($_POST['check_list']) ? $control = $control."1": $control = $control."0";	
			!empty($_POST['town'])? $control = $control."1": $control = $control."0";
			!empty($_POST['state'])? $control = $control."1": $control = $control."0";
			$control = $control."1"; //mail -> je uz overeny na "Prihlasit sa" 
				
			//edit -> min dlzka hesla je 3 znaky	
			(($_POST['pasw'] == $_POST['pasw2']) && (strlen($_POST['pasw']) > 2) && (strlen($_POST['pasw2']) > 2)) ? $control = $control."1": $control = $control."0";
			
			chk_crypt($_POST['code'])? $control = $control."1": $control = $control."0";			
			//echo " CODE: ".$control;	
			if ($control == "11111111") {
				openMySQL($host, $user, $passwd, $db);
				mysql_query("insert into author values ('','".$_POST['a_name']."','".$_POST['age']."','".$_POST['job']."','".$_SESSION['mail']."','".$_POST['state']."','".$_POST['town']."','".$_POST['address']."','".md5($_POST['pasw'])."')") or die("Error adding AUTHOR: ".mysql_error()."");
				$a_id = mysql_insert_id();
			//zaslanie aktivacneho mailu po evidencii uzastinika, robotu sa nastavi atribut default show = 0 
				$reg_time = time();
				$sql_check_hash = mysql_query("select * from activation where id_author = ".$a_id);
				if (!mysql_num_rows($sql_check_hash)) {
						$mail = $_SESSION['mail'];
						$pasw = $_POST['pasw'];
						$hash = activate_hash($mail, $pasw, $reg_time);
						mysql_query("insert into activation values ('',".$a_id.",'".$hash."')") or die ("activation error");
						//sendmail($mail, activate_hash($mail, $pasw, $reg_time), $pasw);
						EmailSender::sendActivationEmail($mail, $hash, $pasw);
				}
				
			
			
			//data prenasane do prihlas_robot
				// $_SESSION['mail'] = $mail -> definovane pri prechode z "Prihlasit sa"
				$_SESSION['pasw'] = $_POST['pasw'];
				//$_SESSION['category'] = $_POST['check_list'];
				//$_SESSION['robot'] = $_POST['r_name'];
				$_SESSION['author'] = $_POST['a_name'];
				$_SESSION['author_id'] =  $a_id;
				$_SESSION['subnames'] =  $_POST['da_name'];
				redir("index.php?page=login2");
				
			} else {
			//novy zapis do premennych pre pripad nesplnenia $control == 11111111
			
				$a_name = $_POST['a_name'];
				$da_name = $_POST['da_name']; 
				//$r_name = $_POST['r_name'];
				$age = $_POST['age'];
				$job = $_POST['job'];
				$mail = $_SESSION['mail'];
				//$category = $_POST['category'];
				$address = $_POST['address'];
				$town = $_POST['town'];
				$state = $_POST['state'];
				$pasw = $_POST['pasw'];
				$pasw2 = $_POST['pasw2'];
				
				//$checkbox = array();
				//$ch=0;
				//if(!empty($_POST['check_list'])) {
				//	foreach($_POST['check_list'] as $check) {	
				//	$checkbox[$ch] = $check;
				//	$ch++; 
				//	}
				//}
				//echo "Sutaze su: ".var_dump($checkbox)."<br/>";
				
				//parceovanie $control do pola
				for ($i=7; $i>=0; $i--) {
							$key[$i] = $control % 10;
							$control /= 10;
				}
			}	
	////KED SOM PRIHLASENY VYPIS			
		} elseif (!empty($_SESSION['a_id']) && !isset($_GET['key'])) {
			$wim = 1;
			//osetrenie pre spravny chod "edit" v podmienkach prihlaska_robot.php ..doriesit "LOL :D"
			//$_SESSION['robot_id'] = "gettig";
			//pripad nezadaneho mena robota pre akciu pridaj!
			if ($_GET['action'] == "error"){
				$r_name2 = "Zadajte nazov!";
			}
			
			//pripad akcie DELETE ITEM ROBOT + POTREBA SET SHOW = 1, YEAR = 0, ZIADNE MAZANIE NADRZAKA!
			if ($_GET['action'] == "delete"){
				//echo "DELETE";
				$robot_data = $_POST['r_name'];
				$pieces = explode("&", $robot_data);
				$pieces[0]; //robot id
				$pieces[1]; //robot name
				openMySQL($host, $user, $passwd, $db);
				//vymazanie robota 
				mysql_query("UPDATE robot SET `show` = 0 WHERE id_robot = ".$pieces[0]) or die("Error fadeing ROBOT: ".mysql_error()."");
				//vymazanie priradenych kategorii robota
				mysql_query("DELETE FROM competitions_contestants WHERE robot_id=".$pieces[0]."'");
			}
			
			
			openMySQL($host, $user, $passwd, $db);
			$sql = mysql_query("select * from author where id_author ='".$_SESSION['a_id']."'");
			$author = mysql_fetch_object($sql);
			//$control nastavime na 11111111
			$key = array();
			for($i=0;$i<8;$i++){
				$key[$i]="1";
			}
			
			//novy zapis dat z DB do premennych
				$a_name = $author->name_surname;
				//$r_name = $_POST['r_name'];
				$age = $author->age;
				if ($age == 0) {$age = "";};
				$job = $author->job;
				$mail = $author->email;
				$mail_atrib = "disabled=\"disabled\"";
				$town = $author->town;
				$state = $author->state;
				$address = $author->contact;
				
				//udaje z cateogry_tag
				$sql = mysql_query("select * from robot where id_author ='".$_SESSION['a_id']."'");
				$robot = mysql_fetch_object($sql);
				$robot_id = $robot->id_robot;
				$r_name = $robot->name;
				
				$sql2 = mysql_query("select * from competitions_contestants where robot_id ='".$robot_id."'");			
				$ch=0;
				while ($competition = mysql_fetch_object($sql2)) {
					$checkbox[$ch] = $competition->competition_id;
					$ch++; 
				}
				$errmsg = "";
				//echo "CATEGORY: ".var_dump($checkbox);
				
		////KED SOM PRIHLASENY + ZLE DATA VYPLNENE
		}	elseif (!empty($_SESSION['a_id']) && isset($_GET['key'])) {
		
				$wim = 1;
				$control = "";
				
				!empty($_POST['a_name'])? $control = $control."1": $control = $control."0";
				isnum_age($_POST['age'])? $control = $control."1": $control = $control."0";
				$control = $control."1"; //contact - vzdy uz OK, nekontrolujem
				!empty($_POST['town'])? $control = $control."1": $control = $control."0"; //vzdy ok pre sutaze: zadavaju sa uz inde -> EDIT (TOWN)
				!empty($_POST['state'])? $control = $control."1": $control = $control."0"; // EDIT (STATE)
				$control = $control."1"; // mail (disabled) vzdy ok pre logged uzivatela
				//edit -> min dlzka hesla je 3 znaky	
				(($_POST['pasw'] == $_POST['pasw2']) && (strlen($_POST['pasw']) > 2) && (strlen($_POST['pasw2']) > 2)) ? $control = $control."1": $control = $control."0";
				$control = $control."1"; // pre logged uzivatela uz nieje potrebna captcha 		
				//echo "CODE: ".$control;	
				
				if ($control == "11111111") {
				openMySQL($host, $user, $passwd, $db);
				//echo "uprava";
				mysql_query("update author set name_surname = '".$_POST['a_name']."', age = '".$_POST['age']."', job = '".$_POST['job']."', state = '".$_POST['state']."', town = '".$_POST['town']."', contact = '".$_POST['address']."', passwd = '".md5($_POST['pasw'])."' where id_author = '".$_SESSION['a_id']."'") or die("Error editing AUTHOR: ".mysql_error()."");
				//mysql_query("insert into author values ('','".$_POST['a_name']."','".$_POST['age']."','".$_POST['job']."','".$_POST['mail']."','".$_POST['address']."','".md5($_POST['pasw'])."')") or die("Error adding AUTHOR: ".mysql_error()."");
				//data prenasane do opat na prihlaska.php
					//$_SESSION['mail'] = $_POST['mail'];
					//$_SESSION['pasw'] = $_POST['pasw'];
					//$_SESSION['category'] = $_POST['check_list'];
					//$_SESSION['robot'] = $_POST['r_name'];
					//$_SESSION['author'] = $_POST['a_name'];
					//$_SESSION['author_id'] =  mysql_insert_id();
				redir("index.php?page=login");	
			} else {
				
				//novy zapis do premennych pre pripad nesplnenia $control == 11111111
				$a_name = $_POST['a_name'];
				$da_name = $_POST['da_name'];
				//$r_name = $_POST['r_name'];
				$age = $_POST['age'];
				$job = $_POST['job'];
				
				//speci pre mail (disabled)
				openMySQL($host, $user, $passwd, $db);
				$sql = mysql_query("select * from author where id_author ='".$_SESSION['a_id']."'");
				$author = mysql_fetch_object($sql);
				$mail = $author->email;
				$mail_atrib = "disabled=\"disabled\"";
				
				//$category = $_POST['category'];
				$state = $_POST['state'];
				$town = $_POST['town'];
				$address = $_POST['address'];
				$pasw = $_POST['pasw'];
				$pasw2 = $_POST['pasw2'];

				//echo "Sutaze su: ".var_dump($checkbox)."<br/>";
				
				//parceovanie $control do pola
				for ($i=7; $i>=0; $i--) {
							$key[$i] = $control % 10;
							$control /= 10;
				}
			}	
		
		}

				
		
?>

		<div Id="content">
			<div style="text-align: center;">
				<b>&nbsp1. Registrácia účastníka </b><i>----> 2. Registrácia robota/robotov ----> 3. Potvrdenie, koniec</i>
				<br/><br/>
			</div>
			<H2>Pokyny</H2>
			<P>
			<UL>
				 <LI> Jednou prihláškou sa môžete prihlásiť aj do viacerých kategórií.</li>
				 <LI> Do jednej kategórie môže prihlásiť aj viac robotov - každého samostatnou 
					  prihláškou.</li>
				 <LI> Súťaže sa môžu zúčastniť jednotlivci a tímy (max. 5-členné) bez
					  ohľadu na vek či zamestnanie.</li>
				 <LI> Prihlášku treba vyplniť najneskôr do <B>1.&nbsp;apríla 2013</B>
					  pomocou tohoto formulára.</li>
				 <LI> <B>Používajte</B> diakritiku, prosím!</li>
			</UL>

			<BR/><BR/>
			<?php
				if ($wim == 0){
					echo "<H2>Prihláška</H2>";
				} else {
					echo "<H2>Osobný profil súťažiaceho</H2>";
				}				
			?>
			<!-- javascript pre dynamicke menenie action pre formular -->
			<script type="text/javascript">
				function OnSubmitForm()
				{
				  if(document.pressed == 'Edituj roboty')
				  {
				   document.myform.action ="index.php?page=lor";
				  } else if(document.pressed == 'Uprav' || document.pressed == 'Pokračovať registráciou robota')
				  {
					document.myform.action ="index.php?page=login&key";
				  } 
				  return true;
				}
			</script>
			
			<FORM name="myform" onsubmit="return OnSubmitForm();" Method="POST">
			<TABLE class="form"> 

			<?php	
			// vypis mena robota/ zoznamu robotov pre prihlaseneho uzivatela	
				if ($wim == 0){
					//echo "<TR><TD class=\"reddot\">●&nbsp </TD><TD class=\"title\">Meno robota:</TD>";
					//echo "<TD class=\"input\"><INPUT Type=\"text\" Name=\"r_name\" Size=\"30\" value=\"".$errmsg."\"></TD><TD class=\"notice\"> ● Povinný údaj</TD></TR>";
				} else {
					echo "<TR><TD></TD><TD class=\"title\">Zoznam robotov:</TD>";
					//echo "<TR><TD class=\"title\"></TD>";
					//vyhladanie vsetkych robotov autora
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("select * from robot where `show` = 1 and id_author ='".$_SESSION['a_id']."'") or die(mysql_error());
					//$robot = mysql_fetch_object($sql);
					$first = 1;
					while ($robot = mysql_fetch_object($sql)) {
						if ($first == 1){
							echo "<TD class=\"input\">".$robot->name."</TD></TR>";
							$first = 0;
						}else{
							echo "<TD></TD><TD class=\"title\"></TD><TD class=\"input\">".$robot->name."</TD></TR><TR>";
						}
					}
					echo "<TD></TD><TD class=\"title\"></TD><TD class=\"input\"><INPUT Type=\"submit\"  Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Edituj roboty\"></TD></TR>";
					//echo "</select></TD>";
					//echo "<TD class=\"input\"><INPUT Type=\"submit\"  Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Edituj\">";
					//echo "<INPUT Type=\"submit\"  Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Vymaž\"></TD></TR>";
					//echo "<TR><TD class=\"title\"></TD><TD class=\"input\"><INPUT Type=\"text\" Name=\"r_name2\" value=\"".$r_name2."\" Size=\"30\"></TD>";
					//echo "<TD class=\"input\"><INPUT Type=\"submit\"  Name=\"edit\" onclick=\"document.pressed=this.value\" value=\"Pridaj\"></TD></TR>";
				}	 
				
			?>
					<?php
						if (($key[0] == 0) && (isset($_GET['key']))) {
							$errmsg = "";
							$errmsg2 = "Nevyplnené!";
						} else {
							$errmsg = $a_name;
							$errmsg2 = "Povinné údaje";
						}							
					?>
			<TR><TD><br/></TD></TD>	
			<TR><TD class="reddot"></TD><TD class="title">Hlavný konštruktér: </td>
			<TD class="input"><INPUT Type="text" Name="a_name" Size="30" value="<?php echo $errmsg;?>"></TD><TD class="notice"> ● <?php echo $errmsg2; ?></TD></TR>
			
			<TR><TD class="reddot"></TD><TD class="title">Ďalší autori: </td>
			<TD class="input"><INPUT Type="text" Name="da_name" Size="30" value="<?php echo $da_name;?>"></TD><TD class="notice"></TD></TR>
			<TR><TD class="reddot"></TD><TD colspan="2"><i>Viacero mien oddeľte čiarkami<br/><br/></i></TD></TR>
					<?php
						if (($key[1] == 0) && (isset($_GET['key']))) {
							$errmsg = $age;
							$errmsg2 = " ● Nieje číslo!";
						} else {
							$errmsg = $age;
							$errmsg2 = "";
						}							
					?>
			<TR><TD class="reddot"></TD><TD class="title">Vek: </td>
			<TD class="input"><INPUT Type="text" Name="age" Size="30" value="<?php echo $errmsg; ?>"></TD><TD class="notice"><?php echo $errmsg2; ?></TD></TR>
					
			<TR><TD></TD><TD class="title">Škola, zamestanie: </td>
			<TD class="input"><INPUT Type="text" Name="job" Size="30" value="<?php echo $job; ?>"></TD><TD></TD></TR>
				<?php
					//nepouziva sa uz TIEZ preto wim = 2, povodne bolo 0
					if ($wim == 2){
						echo "<TR><TD class=\"reddot\">●</TD><TD class=\"title\">Súťažná kategória:</TD>";
						echo "<TD class=\"input\">";
						echo "<UL>";
						openMySQL($host, $user, $passwd, $db);
						$sql = mysql_query("select * from category");
						if ( ($key[3] == 0) || empty($_SESSION['a_id']) ) {
							while ($category = mysql_fetch_object($sql)) {
								echo "<li><input type=\"checkbox\" Name=\"check_list[]\" value=\"".$category->id_category."\">".$category->name."</li>";
							}
						echo "<TD class=\"notice\"> ● Povinný údaj</TD>";
						} elseif ( ($key[3] == 1) || !empty($_SESSION['a_id']) ) {
							//echo "KEY:".$key[3]." session: ".$_SESSION['a_id'];
							while ($category = mysql_fetch_object($sql)) {
								$duplic = false;
								foreach($checkbox as $check) {	
									if ($check == $category->id_category){
										echo "<li><input type=\"checkbox\" Name=\"check_list[]\" checked=\"checked\" value=\"".$category->id_category."\">".$category->name."</li>";
										$duplic = true;
									} 										
								}
								echo ($duplic == false) ? "<li><input type=\"checkbox\" Name=\"check_list[]\" value=\"".$category->id_category."\">".$category->name."</li>" : "";
							}	
						}
						echo "</UL>";
						echo "</TD></TR>";
					}			
				?>
				<?php
						//Kontakt - adresa uz nieje povinna ;)
						if (($key[2] == 0) && (isset($_GET['key']))) {
							$errmsg = "";
						} else {
							$errmsg = $address;
						}							
				?>
			<TR><TD class="reddot"></TD><TD class="title">Kontakt (adresa, tel.):      </TD>
			<TD class="input"><TEXTAREA  Name="address" Rows="3" Cols="24"><?php echo $errmsg; ?></TEXTAREA></TD><TD class="notice"></TD></TR>
				
				<?php
						if (($key[3] == 0) && (isset($_GET['key']))) {
							$errmsg = "";
							$errmsg2 = "Nevyplnené!";
						} else {
							$errmsg = $town;
							$errmsg2 = "";
						}							
				?>
			<TR><TD class="reddot"></TD><TD class="title">Mesto, obec:     </TD>
			<TD class="input"><Input Type="text" Name="town" id = "town" Size="30" value="<?php echo $errmsg; ?>"></TD><TD class="notice"> ● <?php echo $errmsg2; ?></TD></TR>	
				
				<?php
						if (($key[4] == 0) && (isset($_GET['key']))) {
							$errmsg = "Zlá hodnota!";
						} else {
							$errmsg = $state;
						}							
				?>
			<TR><TD class="reddot"></TD><TD class="title">Krajina:     </TD>
			<TD class="input">
				<select name= "state" style="width:217px">
					<?php
						$state_name = array("Slovensko", "Česko", "Poľsko", "Rakúsko", "Nemecko", "iná...");
						$state_no = array ("SR", "CR", "PL", "AUT", "GER", "other");
						$i=0;
						foreach ($state_no as $tag){
							if ($tag == $state){
								echo "<option value=\"".$tag."\" selected>".$state_name[$i]."</option>";
							} else {
								echo "<option value=\"".$tag."\">".$state_name[$i]."</option>";
							}
							$i++;
						}	
					?>
				</select> 	
			</TD><TD class="notice"> ● </TD></TR>	
				<?php
						$errmsg = $_SESSION['mail'];
						//echo "EMAIL PRESIEL".$errmsg;		
				?>	
			<TR><TD class="reddot"></TD><TD class="title">E-mail (Login):</TD>
			<TD class="input"><Input Type="text" Name="mail" Size="30" disabled="disabled" value="<?php echo $errmsg; ?>"></TD><TD class="notice"> ● </TD></TR>
				<?php
						if (($key[6] == 0) && (isset($_GET['key']))) {
							$errmsg = " Heslá sa nezhodujú alebo je príliš krátke (min. 3 znaky)!";
						} else {
							$errmsg = "";
						}
							
						if ($wim == "1") {
							$val_pwd1 = "value=\"opaopao\"";
							$val_pwd2 = "value=\"ejharup\"";		
						} else {
							$val_pwd1 = "";
							$val_pwd2 = "";
						}
				?>
			<TR><TD class="reddot"></TD><TD class="title">Heslo:      </TD>
			<TD class="input"><Input Type="password" Name="pasw" <?php echo $val_pwd1 ?> Size="30"></TD><TD class="notice"> ● <?php echo $errmsg; ?></TD></TR>
			
			<TR><TD class="reddot"></TD><TD class="title">Potvrďte heslo:      </TD>
			<TD class="input"><Input Type="password" Name="pasw2" <?php echo $val_pwd2 ?> Size="30"></TD><TD class="notice"> ● </TD></TR>
			</TABLE>
			
			<?php 
				// overenie pre captcha len pre registraciu
				if ($wim == 0){
					dsp_crypt(0,1); 
					if ($cap) {				
						$errmsg = "Zlá captcha!";
					} else {
						$errbg = ""; $errmsg = "";
					}
				}
				if (($key[8] == 0) && (isset($_GET['key']))) {
					$errmsg = "Zlá captcha!";
				} else {
					$errmsg = "";
				}			
				
				if ($wim == 0){
				//CAPTCHA VYPIS
					echo "<TABLE class=\"form\">";
					echo "<TR><TD class=\"reddot\"></TD><TD class=\"title\">Aký je tu text?</TD>";
					echo "<TD class=\"input\"><input type=\"text\" id=\"capt\" name=\"code\" Size=\"30\" onclick=\"this.value='';\"></TD><TD class=\"notice\"> ● ".$errmsg."</TD></TR>";
					echo "</TABLE>";
					echo "<br/>";
				}	
				//SUBMIT VYPIS
				if ($wim == 0){
					echo "<TABLE>";
					echo "<TR><TD class=\"reddot\"></TD><TD class=\"title\"></TD><TD class=\"input\"><INPUT Type=\"submit\" onclick=\"document.pressed=this.value\" Value=\"Pokračovať registráciou robota\"></TD></TR>";
					echo "</TABLE>";
				} else {
					echo "<br/>";
					echo "<INPUT Type=\"reset\" Value=\"Vymazať\">";
					echo "<INPUT Type=\"submit\" onclick=\"document.pressed=this.value\" Value=\"Uprav\">";
				}
				//echo "TIME:".time();
			?>
			<br/><br/>
			Uzávierka prihlášok je 1. 4. 2013, 23:59:59.
			</FORM>
			
		</div>