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
			<a class="active item" href="index.php">
				Používatelia
			</a>
			<a class="item" href="sutaze.php">
				Súťaže
			</a>
			<a class="item" href="galeria.php">
				Galéria
			</a>
			<a class="item" href="nastavenia.php">
				Nastavenia
			</a>
		</div>
		<div class="ui divider" style=""></div>
		<div class="ui toggle green checkbox passwd_toggle" style="">
			<input type="checkbox" name="public">
			<label>Editovanie hesiel</label>
		</div>
	</div>
	<div class="ui styled accordion" style="width:80%; margin-right:1%; float:right;">
		<div class="title">
			<i class="dropdown icon"></i>
			 <i class="add user icon"></i>  Pridaj užívateľa
		</div>
		<div class="content">
			<table class="ui compact table" style="border:none">
				<tbody class="add_user">
					<?php
					$inst->addUser();
					?>
				</tbody>
			</table>
		</div>
		</div>
		
		
		<table class="ui striped celled sortable table" style="width:80%; margin-right:1%; float:right">
			<thead>
				<tr>
					<th class="no-sort"></th>
					<th>Meno</th>
					<th>Vek</th>
					<th>Práca</th>
					<th>Email</th>
					<th>Štát</th>
					<th>Mesto</th>
					<th>Adresa</th>
					<th>Heslo</th>
					<th class="no-sort">Zmazať</th>
				</tr></thead>
				<tbody id="users_body">


					



				</tbody>

			</table>

		</body>
		<script type="text/javascript">

/* Function that on click changes text to textfield and on lost focus pushes
   the changes to database.
   */
   var update_funct = function() {
	var tex = $(this).text(); // Get current value of cell
	var textarea = $('<textarea id="gird_val" style="width:100%; height:100%;">'+tex+'</textarea>'); // Create a textfield with the current value
	$(this).html(textarea); // Render the textfield on webpage
	var parent = $(this).parent(); // Get the parent of the cell = table row containing user id
	textarea.focus(); // Set the focus on the created textarea
	$(this).unbind(); // Disable the click function on the textarea so the cursor won't move to the beginning everytime you click on it
	textarea.blur(function(){ // When you click outside of the the textarea (the textarea loses focus)
		$('.gird_edit').unbind(); // Flush all binded events
		$('.gird_edit').bind({ // Rebind the click function
			click: update_funct
		});
		var type = $(this).parent().data("type"); // Get the column name of edited field
		var id = $(this).parent().parent().data("id"); // Get the id of user whose data was changed
		var change = parent.find("#gird_val").val(); // Get the new value
		if (type=="passwd") {
			change = CryptoJS.MD5(change);
		};

		textarea.parent().html(""+change+""); // Change the webpage from textarea to text again with new value
		$.post("send.php", { // Send the retrieved data to a script that pushes it to database (SQL UPDATE)
			type1: type,
			id1: id,
			val1:change,
			table1: "author",
			id_name1: "id_author"
		}).done(function() {
   		get_table();
  });
	})
	
}

var delete_funct = function() {
	var row=$(this).parent().parent().parent().parent();
	var id = row.data("id");
	row.remove();
	$.post("delete.php", { // Send the retrieved data to a script that pushes it to database (SQL UPDATE)
		id1:id,
		table1: "author",
		id_name1: "id_author"
	});
}

var get_table = function() {
	$.post("load_users.php",
		function(data){
			handleData(data);
		});
var handleData = function(data){
	$('#users_body').html(data);
	$('.gird_edit').bind({ // Bind the update function on webpage load 
		click: update_funct
	});
	$('.gird_delete').bind({ // Bind the delte function on webpage load 
		click: delete_funct
	});
	$('.delete_button').popup({
		hoverable: true,
		delay: {
			show: 300,
			hide: 800
		}
	});
}

}
$( document ).ready(function() {
	get_table();

	$('.ui.accordion')
	.accordion()
	;
	$('.gird_edit').bind({ // Bind the update function on webpage load 
		click: update_funct
	});
	$('.gird_delete').bind({ // Bind the delte function on webpage load 
		click: delete_funct
	});
	$('table.sortable').tablesort();
	$('.delete_button').popup({
		hoverable: true,
		delay: {
			show: 300,
			hide: 800
		}
	});
	$('.passwd_toggle').checkbox({
		onChecked: function() {
			$("td.passw").toggleClass("disabled");
		},
		onUnchecked: function() {
			$("td.passw").toggleClass("disabled");
		}
	});
	$('.ui.dropdown').dropdown();
});

</script>
</html>
