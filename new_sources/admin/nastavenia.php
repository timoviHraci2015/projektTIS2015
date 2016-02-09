<?php
session_start();
if(!session_is_registered(myusername)){
	header("location:login.php");
}

require_once("FormsController.php");
require_once("functions.php");
openMySQL($host, $user, $passwd, $db);
$inst = new FormsController();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Istrobot</title>
	<script src="assets/jquery-2.1.1.min.js"></script>
	<script src="assets/dist/semantic.min.js"></script>
	<script src="assets/dist/components/progress.js"></script>
	<script src="assets/jquery.tablesort.min.js"></script>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/md5.js"></script>
	<link rel="stylesheet" href="assets/dist/semantic.min.css">
	<link rel="stylesheet" href="assets/dist/components/table.min.css">
	<style>
		.ui.table tbody tr td a {color:black;}
		td.selectable.gird_edit {
			padding-left:.5em!important;
			padding-right:.5em!important;
		}
		tbody.add_user > form > tr > th {
			max-width:100px;
		}
		.ui.table tr td {border-top:none!important;}
		.ui.table tr th {max-width: 100px!important;}
	</style>
</head>
<body style="margin:auto; padding-top:1em; padding-bottom:1em; font-family:Arial;">
	<!-- 	 -->
	<div class="ui segment green" style="width:17%; margin:0em 1% 0 1%; float: left; position:relative;">
		<h2 class="ui header">Administrácia</h2>
		<div class="ui divider"></div>
		<div class="ui secondary vertical green pointing menu" style="width:100%;">
			<a class="item" href="index.php">
				Používatelia
			</a>
			<a class="item" href="sutaze.php">
				Súťaže
			</a>
			<a class="item" href="galeria.php">
				Galéria
			</a>
			<a class="active item" href="nastavenia.php">
				Nastavenia
			</a>
		</div>

	</div>
	<div class="ui stacked segment" style="width:80%; margin-right:1%; float:right; margin-top:0">
		<h1 class="ui header">Zmena roku</h1>
		<?php
		$inst->changeYear();
		?>

	</div>



</body>
<script type="text/javascript">



	$( document ).ready(function() {

		$('.ui.accordion')
		.accordion()
		;

		$('.ui.dropdown').dropdown();
	});

</script>
</html>
