<?php	
		//session_start();		
		if (!isset($_SESSION['sudo'])) {
			redir("index.php?page=logme");
		} else {
				openMySQL($host, $user, $passwd, $db);
				if (isset($_POST['set'])){
					mysql_query("update robot set subauthor = '".$_POST['subnames']."', name = '".$_POST['rname']."', procesor ='".$_POST['cpu']."', 
					memory ='".$_POST['ram']."', frequency ='".$_POST['freq']."', sensors ='".$_POST['sensors']."', drive ='".$_POST['drive']."', 
					power_supply ='".$_POST['power']."', prog_language ='".$_POST['prog_lang']."', interestings ='".$_POST['misc']."', web ='".$_POST['web']."', 
					description ='".$_POST['descript']."' where id_robot ='".$_GET['id']."'") or die("Error editing ROBOT: ".mysql_error()."");
				}
				
					$sql = mysql_query("select * from robot where id_robot = '".$_GET['id']."'") or die(mysql_error());
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
		}
		
?>
	<DIV Id="content">
			<FORM name="robot_data" Method="POST">
				<TABLE class="form">							
					<TR><TD class="reddot"></TD><TD class="title">Názov:	</TD><TD>  <INPUT Type="text" Name="rname" Size="30" value="<?php echo $rname; ?>"> </TD><TD class="notice"></TD></TR>
					<TR><TD class="reddot"></TD><TD class="title">Spoluautori:</TD><TD><INPUT Type="text" Name="subnames" Size="30" Value="<?php echo $subnames ?>"></td></tr>
					<TR><TD class="reddot"></TD><TD class="title">Procesor:		</TD><TD>  <INPUT Type="text" Name="cpu" Size="30" value="<?php echo $cpu; ?>">  </TD><TD class="notice"></TD></TR>
					<TR><TD></TD><TD class="title">Velkost pamäte:    </TD><TD>     <INPUT Type="text" Name="ram" Size="30" value="<?php echo $ram; ?>">    </TD></TR>
					<TR><TD></TD><TD class="title">Frekvencia:        </TD><TD>     <INPUT Type="text" Name="freq" Size="30" value="<?php echo $freq; ?>"><BR> </TD></TR>
					<br/>
					<TR><TD></TD><TD class="title">Senzory:           </TD><TD>     <INPUT Type="text" Name="sensors" Size="30" value="<?php echo $sensors; ?>">   </TD></TR>
					<TR><TD></TD><TD class="title">Pohon:             </TD><TD>     <INPUT Type="text" Name="drive" Size="30" value="<?php echo $drive; ?>">     </TD></TR>
					<TR><TD></TD><TD class="title">Napájanie:         </TD><TD>     <INPUT Type="text" Name="power" Size="30" value="<?php echo $power; ?>">     </TD></TR>
					<br/>
					<TR><TD class="reddot"></TD><TD class="title">Programovací jazyk:</TD><TD>     <INPUT Type="text" Name="prog_lang" Size="30" value="<?php echo $prog_lang; ?>">  </TD><TD class="notice"></TD></TR>
					<TR><TD></TD><TD class="title">Zaujímavosti:      </TD><TD>     <INPUT Type="text" Name="misc" Size="30" value="<?php echo $misc; ?>">      </TD></TR>
					<TR></TR>
					<TR><TD></TD><TD class="title">Domáca stránka robota:</TD><TD><INPUT Type="text" Name="web" Size="30" value="<?php echo $web; ?>"></TD></TR>
					<tr><TD></TD><td class="title">Popis:</td><td><TEXTAREA Name="descript" Rows=5 Cols=24><?php echo $descript; ?></TEXTAREA>
					<TR><TD></TD><td class="title"></td><TD><br/><INPUT style="width: 150px" Type="submit" name="set" Value="Uprav"></TD></TR>			
				</TABLE>									
			</FORM>	
	</DIV>	