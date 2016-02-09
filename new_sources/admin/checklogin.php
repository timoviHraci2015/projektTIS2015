<?php
session_start();
require_once("functions.php");
echo "<b>WTF bro</b></br>";

if ($link = spoj_s_db()) {
	echo "<br>GOT HERE<br>";
	$myusername=$_POST['username']; 
	$mypassword=$_POST['password']; 
	echo " ".$mypassword." ";
	//tets
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$mypassword=md5($mypassword);
	$sql="SELECT * FROM admin WHERE name='$myusername' and passwd='$mypassword'";
	$result=mysql_query($sql,$link);
	$count=mysql_num_rows($result);
	$row=mysql_fetch_assoc($result);
	if($count==1){
		session_register("myusername");
		session_register("mypassword"); 
		header("location:index.php");
	}
	else {
		echo " ".$count." ".$mypassword;
	}
}
?>