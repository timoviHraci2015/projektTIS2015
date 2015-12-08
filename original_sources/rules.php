<?php
	if (isset($_GET['type'])) {
	    switch($_GET['type']) {
			case "follower": 		include_once("follower.php"); break;
			case "umouse": 			include_once("umouse.php"); break;
			case "ketchup": 		include_once("ketchup.php"); break;
			case "freestyle":		include_once("freestyle.php"); break;
			case "common":			include_once("common.php"); break;
			case "example":			include_once("examples.php"); break;
		}
	} else {
		include_once("headRules.php");
	}
?>