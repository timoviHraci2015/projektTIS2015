<?php 
				require_once("functions.php");
				if ($link = spoj_s_db()) {
					$sql = "SELECT * FROM author ORDER BY id_author ASC";
					$result = mysql_query($sql, $link);
					$html="";
					while ($row = mysql_fetch_assoc($result)) {
						$warning = false;
						foreach ($row as $key => $value) {
							if($value=="") $warning=true;
						}

						$html.= "<tr data-id='".$row["id_author"]."'>\n";
						if($warning) {$html.= "<td class='error'><i class='warning sign big icon'></i></td>\n";}
						else {$html.= "<td></td>\n";}
						$html.= "<td class='selectable gird_edit' data-type='name_surname'>".$row["name_surname"]."</td>\n";
						$html.= "<td class='selectable gird_edit' data-type='age'>".$row["age"]."</td>\n";
						if($row["job"]==""){
							$html.= "<td class='selectable warning gird_edit' data-type='job'>".$row["job"]."</td>\n";
						} else {
							$html.= "<td class='selectable gird_edit' data-type='job'>".$row["job"]."</td>\n";
						}

						if($row["email"]==""){
							$html.= "<td class='selectable warning gird_edit' data-type='email'>".$row["email"]."</td>\n";
						} else {
							$html.= "<td class='selectable gird_edit' data-type='email'>".$row["email"]."</td>\n";
						}

						if($row["state"]==""){
							$html.= "<td class='selectable warning gird_edit' data-type='state'>".$row["state"]."</td>\n";
						} else {
							$html.= "<td class='selectable gird_edit' data-type='state'>".$row["state"]."</td>\n";
						}

						if($row["town"]==""){
							$html.= "<td class='selectable warning gird_edit' data-type='town'>".$row["town"]."</td>\n";
						} else {
							$html.= "<td class='selectable gird_edit' data-type='town'>".$row["town"]."</td>\n";
						}

						if($row["contact"]==""){
							$html.= "<td class='selectable warning gird_edit' data-type='contact'>".$row["contact"]."</td>\n";
						} else {
							$html.= "<td class='selectable gird_edit' data-type='contact'>".$row["contact"]."</td>\n";
						}

						$html.= "<td class='selectable disabled gird_edit passw' data-type='passwd'>".$row["passwd"]."</td>\n";
						$html.= "<td class='delete'><a class='delete_button'><i class='remove big icon'></i></div><div class='ui flowing inverted popup top left transition hidden'><h4 class='ui header'>Skutočne zmazať používateľa?</h4><div class='ui positive fluid button gird_delete'>Áno</div></a></td>";
						$html.= "</tr>\n\n";
					}
					echo $html;
				}
					?>