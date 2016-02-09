<?php	
		//session_start();
		openMySQL($host, $user, $passwd, $db);
		if (!isset($_SESSION['sudo'])) {
			redir("index.php?page=logme");
		} else {				
			if (isset($_POST['del'])){
				mysql_query("DELETE FROM admin WHERE id_admin = '".$_POST['id']."'") or die ("ERROR delete admin: ".mysql_error());	
			} elseif (isset($_POST['del'])){
				mysql_query("UPDATE admin SET passwd = '".md5($_POST['passwd'])."' WHERE id_admin = '".$_POST['id']."'")or die ("ERROR update admin: ".mysql_error());
			} elseif (isset($_POST['add'])){
				mysql_query("insert into admin values ('','".$_POST['name']."','".md5($_POST['passwd'])."')") or die("Error add admin: ".mysql_error());
			}
		}
		
?>
	<DIV Id="content">
				
					<?php
						$sql = mysql_query("select id_admin, name from admin") or die(mysql_error());
						while ($admin = mysql_fetch_object($sql)) {
							echo "<FORM name=\"data\" Method=\"POST\"><TABLE><TR>";
							echo "<TD style=\"width: 78px \"><b>".$admin->name."</b></TD><TD><INPUT Type=\"password\" Name=\"passwd\" Size=\"7\" value=\"urpi\"> ";
							echo "<INPUT Type=\"hidden\" Name=\"id\" value=\"".$admin->id_admin."\">";
							echo "<INPUT Type=\"submit\" name=\"edit\" Value=\"Uprav\"> <INPUT Type=\"submit\" name=\"del\" Value=\"Zmaž\">";
							echo "</TD></TR></TABLE></FORM>";
						}
					?>
					<TABLE>	
						<TR>
							<TD><FORM name="data" Method="POST">
								<INPUT Type="text" Name="name" size="7">
								<INPUT Type="password" Name="passwd" size="7">
								<INPUT Type="submit" name="add" Value="Pridaj">
							</TD>
						</TR>	
					</TABLE>									
			</FORM>	
	</DIV>	