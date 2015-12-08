<?php
require_once("config.php");
require_once("functions.php");
require("top.php");

if (isset($_GET['page'])) {
	    switch($_GET['page']) {
			case "news": 		include_once("news.php"); break;
			case "stats": 		include_once("stats.php"); break;
			case "rules": 		include_once("rules.php"); break;
			case "advice": 		include_once("poradna.php"); break;
			case "archive": 	include_once("archive.php"); break;
			case "login": 		include_once("prihlaska.php"); break;
			case "login2":		include_once("prihlaska_robot.php"); break;
			case "lor":			include_once("mine_robots.php"); break;
			case "logout":		include_once("notice.php"); break;
			case "robots": 		include_once("roboty.php"); break;
			case "robotinfo":	include_once("robot_info.php"); break;
			case "notice":		include_once("notice.php"); break;
			case "logme":		include_once("logme.php"); break;
			case "confirm":		include_once("confirm.php"); break;
			default: 			include_once("roboty.php"); break;
		}	
		}else {
			include_once("news.php"); 
		}
		
include_once("footer.php");
?>