<?php	
		//session_start();
		openMySQL($host, $user, $passwd, $db);	
		if (!isset($_SESSION['sudo'])) {
			redir("index.php?page=logme");
		} else{
			if (isset($_POST['set'])){
				mysql_query("update author set name_surname = '".$_POST['a_name']."', age = '".$_POST['age']."', job = '".$_POST['job']."', state = '".$_POST['state']."', town = '".$_POST['town']."', contact = '".$_POST['address']."' where id_author = '".$_GET['id']."'") or die("Error editing AUTHOR: ".mysql_error()."");
			}
			$sql = mysql_query("select * from author where id_author ='".$_GET['id']."'");
			$author = mysql_fetch_object($sql);
			
			//novy zapis dat z DB do premennych
				$a_name = $author->name_surname;
				$age = $author->age;
				if ($age == 0) {$age = "";};
				$job = $author->job;
				$mail = $author->email;
				$mail_atrib = "disabled=\"disabled\"";
				$town = $author->town;
				$state = $author->state;
				$address = $author->contact;
		}
		
		
?>
<DIV Id="content">
	<FORM name="myform" Method="POST">
		<TABLE class="form"> 
			<TR>
				<TD class="reddot"></TD><TD class="title">Hlavný konštruktér: </td>
				<TD class="input"><INPUT Type="text" Name="a_name" Size="30" value="<?php echo $a_name;?>"></TD>
			</TR>
			<TR>
				<TD class="reddot"></TD><TD class="title">Vek: </TD>
				<TD class="input"><INPUT Type="text" Name="age" Size="30" value="<?php echo $age; ?>"></TD>
			</TR>		
			<TR>
				<TD></TD><TD class="title">Škola, zamestanie: </TD>
				<TD class="input"><INPUT Type="text" Name="job" Size="30" value="<?php echo $job; ?>"></TD>
			</TR>
			<TR>
				<TD class="reddot"></TD><TD class="title">Kontakt (adresa, tel.): </TD>
				<TD class="input"><TEXTAREA  Name="address" Rows="3" Cols="24"><?php echo $address; ?></TEXTAREA></TD>
			</TR>
			<TR>
				<TD class="reddot"></TD><TD class="title">Mesto, obec: </TD>
				<TD class="input"><Input Type="text" Name="town" id = "town" Size="30" value="<?php echo $town; ?>"></TD>
			</TR>	
			<TR>
				<TD class="reddot"></TD><TD class="title">Krajina:     </TD>
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
				</TD>
			</TR>
			<TR>
				<TD></TD><TD><INPUT Type="submit" name="set" Value="Uprav"></TD>
			</TR>	
		</TABLE>
	</FORM>
</DIV>	