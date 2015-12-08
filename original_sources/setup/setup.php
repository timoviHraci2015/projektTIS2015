<?php	
		//session_start();	
		$gen = 0;	
		if (!isset($_SESSION['sudo'])) {
			redir("index.php?page=logme");
		} else{
			if (isset($_POST['setYear'])) {
				openMySQL($host, $user, $passwd, $db);
				mysql_query("UPDATE competition_year SET year='".$_POST['year']."', gener = 0, stats = 0 WHERE id_cyear = 1");
				$_SESSION['year'] = $_POST['year'];
			} elseif (isset($_POST['del'])) {
				mysql_query("DELETE FROM category WHERE id_category = '".$_POST['id']."'");
				
				//premazanie category tagov pre prebiehajucu registraciu sutaze daneho roku -> mohla by nastat kolizia v systeme
				mysql_query("DELETE FROM category_teg WHERE id_category = '".$_POST['id']."'");
				
			} elseif (isset($_POST['add'])) {
				openMySQL($host, $user, $passwd, $db);
				mysql_query("INSERT INTO category (name) VALUES('".$_POST['name']."')");
			
			} elseif (isset($_POST['generate'])) {
				openMySQL($host, $user, $passwd, $db);
				mysql_query("UPDATE competition_year SET gener = 1");
				
				//generovanie nahodnych cisel pre kategorie
				//$sql = mysql_query("select * from category") or die ("ERROR cateogty: ".mysql_error());
				//$sum = mysql_num_rows($sql);
				
					$sql = mysql_query("SELECT robot.id_robot 
										FROM robot INNER JOIN category_tag ON robot.id_robot = category_tag.id_robot 
										WHERE category_tag.year = ".$_SESSION['year']." GROUP BY robot.id_robot") or die(mysql_error());
					$poc = mysql_num_rows($sql);
					//echo "POCET ROBOTV JE: ".$poc; 
					$array = array();
					for ($i = 1; $i <= $poc; $i++) {
						$array[$i] = $i;
					}
					//var_dump($array);
					//echo "Pocet botov je: ".$poc;
					while ($robot = mysql_fetch_object($sql)) {
						$not_set = true;
						while ($not_set) {
							$sn = rand(1,$poc);
							for ($i = 1; $i <= $poc; $i++) {
								if ($array[$i] == $sn){
									mysql_query("UPDATE category_tag SET start_num = ".$sn." WHERE id_robot = ".$robot->id_robot);
									//echo $i."DONE pre kategoriu ".$k."<br/>";
									$array[$i] = 0;
									$not_set = false;
									break;
								}
							}
						}		
					}
				// end of generate
			
			} 
		}
?>
		<div id="content">
			<FORM Action="index.php?page=setup" Method="POST">
				<TABLE class="form">
					<TR><TD colspan="3"><i>Práve prebieha súťaž pre rok <?php echo $_SESSION['year'] ?></i></TD><TD></TD></TR>
					<TR><TD class="title_lm" colspan="2"><b>Zmeň rok súťaže:</b></TD></TR>
					<TR>
						<TD><INPUT Type="text" Name="year" Size="11">&nbsp;&nbsp;<INPUT Type="submit" name="setYear" Value="Zmeň"></TD>
					</TR>
					<TR><TD colspan = "2"><hr style="width: 255px"></TD></TR>
				</TABLE>
			</FORM>
					<i>&nbsp;Zoznam súťažných kategórií pre rok <?php echo $_SESSION['year'] ?>:</i>
	
					<?php
						openMySQL($host, $user, $passwd, $db);	
						$sql = mysql_query("select * from category") or die ("ERROR cateogty: ".mysql_error());
						while ($category = mysql_fetch_object($sql)) {
							echo "<FORM Action=\"index.php?page=setup\" Method=\"POST\">";
							echo "<TABLE>";
							echo "<TR><TD class=\"input_ctg\">&nbsp;".$category->name."</TD>";			
							echo "<TD><INPUT Type=\"submit\" name=\"del\" Value=\"Zmaž\"></TD>";
							echo "<TD><INPUT Type=\"hidden\" name=\"id\" Value=".$category->id_category."></TD>";
							echo "</TR></TABLE></FORM>";
						}
					
					
					?>
					<FORM Action="index.php?page=setup" Method="POST">
						<TABLE class="form">
							<TR>
								<TD>&nbsp;<INPUT Type="text" Name="name" Size="12"></TD>
								<TD><INPUT Type="submit" name="add" Value="Pridaj"></TD>
							</TR>
						</TABLE>
					</FORM>
					<FORM Action="index.php?page=setup" Method="POST">
						<TABLE class="form">
							<TR><TD colspan = "2"><hr style="width: 255px"></TD></TR>
							<TR>
								<TD>Generuj súťažné listiny: </TD>
								<TD><INPUT Type="submit" name="generate" Value="Generuj"></TD>
							</TR>	
								<?php
									// IS GENERATED?
									$sql_gener = mysql_query("SELECT gener FROM competition_year");
									$item = mysql_fetch_object($sql_gener);
									$gener = $item->gener;
									
									if ($gener == 1){
										$sql = mysql_query("select * from category") or die ("ERROR cateogty: ".mysql_error());
										while ($category = mysql_fetch_object($sql)) {
											echo "<TR><TD><i>Listina pre ".$category->name."<i></TD><TD><a href=\"lists/list".$category->id_category.".php\" target=\"_blank\">Otvor</TD></TR>";
										}	
									}
								?>
						</TABLE>
					</FORM>
					
		</div>