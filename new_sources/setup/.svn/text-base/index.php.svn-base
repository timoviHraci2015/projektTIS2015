<?php
require_once("config.php");
require_once("functions.php");
require("top.php");

if (isset($_GET['page'])) {
	    switch($_GET['page']) {
			case "logme":	include_once("logme.php"); break;			
			case "setup":	include_once("setup.php"); break;
			case "admin":	include_once("admin.php"); break;
			case "users":	include_once("users.php"); break;
			case "user":	include_once("user.php"); break;
			case "robots":	include_once("robots.php"); break;
			case "robot":	include_once("robot.php"); break;
			case "stats":	include_once("stats.php"); break;
			case "logout":	include_once("logme.php"); break;
			default: 		include_once("logme.php"); break;

		}	
		}else {
			include_once("logme.php");
		}
		
include_once("footer.php");
?>