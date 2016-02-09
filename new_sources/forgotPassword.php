<?php 
	if (isset($_POST['forgotPasswordEmail'])) {
		if(Account::resetPassword($_POST['forgotPasswordEmail'])) {
			$msg = "Zmena hesla bola uspesna";
		} else {
			$msg = "Zmena hesla bola neuspesna";
		}
	}
?>

<div id="content">
	<h3>Zabudnute heslo</h3>
	<p>Zadajte vas email, na ktory vam bude odoslane nove heslo</p>
	<FORM Action="index.php?page=forgotPass" Method="POST">
		<TABLE class="form_forgotPassword"> 
			<TR><TD class="title_lm">Email:</TD>
			<TD class="input_lm"><INPUT Type="email" Name="forgotPasswordEmail" Size="20"><?php echo $msg; ?></td></TR>
			<tr><TD class="title_lm"></td><td class="input_lm"><INPUT Type="submit" Value="Poslat nove heslo"></td></tr>			
		</TABLE>				
	</FORM>
</div>