
	<div id="content">
		<h3>Výsledky</h3>
		<TABLE class="form">
			<?php
				// IS GENERATED?
				openMySQL($host, $user, $passwd, $db);	
				$sql_gener = mysql_query("SELECT gener FROM competition_year WHERE id_cyear = 1");
				$item = mysql_fetch_object($sql_gener);
				$gener = $item->gener;
						
				if ($gener == 1){
					$sql = mysql_query("select * from category") or die ("ERROR cateogty: ".mysql_error());
					while ($category = mysql_fetch_object($sql)) {
						echo "<TR><TD><i>Listina pre ".$category->name."<i></TD><TD><a href=\"stats/list".$category->id_category.".php\" target=\"_blank\"> Vyplň</a></TD></TR>";
					}	
				} else {
					echo "<i>Súťaž ešte nebola zahájená</i>";
				}
				
				if (isset($_GET['send'])){
					mysql_query("UPDATE competition_year SET stats = 1 WHERE id_cyear = 1");
				}
				
				//IS STATTED
				$sql_stats = mysql_query("SELECT stats FROM competition_year WHERE id_cyear = 1");
				$item = mysql_fetch_object($sql_stats);
				$stats = $item->stats;
				
				if ($stats == 1){
					echo "<TR><TD colspan = \"2\"><br><b>Výsledky sú zverejnené</b><TD></TR>";
				} else {
					echo "<TR>";
					echo "<TD><br><b>Zverejnenie vysledkov:</b></TD>";
					echo "<TD><br><FORM name=\"myform\" action=\"index.php?page=stats&send\" Method=\"POST\"><INPUT Type=\"submit\" Name=\"commit\" value=\"Potvrď\"></FORM></TD>";
					echo "</TR>";
				}
			?>
		</TABLE>		
	</div>