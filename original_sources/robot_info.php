
		<div Id="content">
			<?php
				if (isset($_GET['item'])){
					openMySQL($host, $user, $passwd, $db);
					$sql = mysql_query("select robot.*, author.name_surname from robot INNER JOIN author ON robot.id_author = author.id_author WHERE id_robot = '".$_GET['item']."'") or die(mysql_error());
					while ($robot = mysql_fetch_object($sql)) {
						
						//novy zapis do premennych z DB
							$aname = $robot->name_surname;
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
							if ($rname == ""){ $rname = "--";}
							//if ($subnames == ""){ $subnames = "--";}
							if ($cpu == ""){ $cpu = "--";}
							if ($ram == ""){ $ram = "--";}
							if ($freq == ""){ $freq = "--";}
							if ($sensors == ""){ $sensors = "--";}
							if ($drive == ""){ $drive = "--";}
							if ($power == ""){ $power = "--";}
							if ($prog_lang == ""){ $prog_lang = "--";}
							if ($misc == ""){ $misc = "--";}
							if ($web == ""){ $web = "--";}
							if ($descript == ""){ $descript = "--";}
									
				} else{
					redir("index.php?page=robots");	
				}
			?>
				<TABLE class="form">
					<TR><TD colspan = "4"><h2><?php echo $rname; ?></h2><h3>Autor(i): 
					<?php 
						if ($subnames == ""){
							echo $aname;
						} else {
							echo $aname.", <i>".$subnames."</i>";
						}	
					?>
					</h3></TD></TR>
					<TR><TD></TD><TD class="title" colspan="2"><h3>Základné údaje</h3></TD><TD>
					<TR><TD class="reddot"></TD><TD class="title">Procesor:	</TD><TD>  <?php echo $cpu; ?> 		</TD></TR>
					<TR><TD></TD><TD class="title">Veľkosť pamäte:    		</TD><TD>  <?php echo $ram; ?>   	</TD></TR>
					<TR><TD></TD><TD class="title">Frekvencia:        		</TD><TD>  <?php echo $freq; ?>		<BR/></TD></TR>
					<TR><TD></TD><TD class="title">Senzory:           		</TD><TD>  <?php echo $sensors; ?>  </TD></TR>
					<TR><TD></TD><TD class="title">Pohon:             		</TD><TD>  <?php echo $drive; ?>    </TD></TR>
					<TR><TD></TD><TD class="title">Napájanie:         		</TD><TD>  <?php echo $power; ?>    </TD></TR>
					<br/>
					<TR><TD></TD><TD class="title">Programovací jazyk:		</TD><TD>  <?php echo $prog_lang; ?></TD></TR>
					<TR><TD></TD><TD class="title">Zaujímavosti:      		</TD><TD>  <?php echo $misc; ?>     </TD></TR>
					<TR></TR>
					<TR>
						<TD></TD><TD class="title">Domáca stránka robota:	</TD><TD>
						<?php
							if ($web != "--"){
								echo "<a target=\"_blank\" href=\"$web\">$web</a>";
							} else {
								echo "--";
							}	
						?>	
						</TD>
					</TR>
					<TR><TD></TD><TD class="title"><h3>Popis</h3>					</TD></TR>
					<TR><TD></TD><TD colspan="3"><?php echo $descript;?></TD></TR>
					<TR><TD></TD><TD><br/><a href="index.php?page=robots"><input type="button" name="test" value="Späť"></a></TD></TR>
				</TABLE>	
		</div>