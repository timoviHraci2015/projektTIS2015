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
	<script src="assets/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet" href="assets/dist/semantic.min.css">
	<link rel="stylesheet" href="assets/dist/components/table.min.css">
	
	<link rel="stylesheet" href="assets/bootstrap-datetimepicker.min.css">
	<style>
		.ui.table tbody tr td a {color:black;}
		td.gird_edit {
			padding-left:.5em!important;
			padding-right:.5em!important;
		}
		.ui.table tr td {border-top:none!important;}
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
			<a class="active item" href="sutaze.php">
				Súťaže
			</a>
			<a class="item" href="galeria.php">
				Galéria
			</a>
			<a class="item" href="nastavenia.php">
				Nastavenia
			</a>
		</div>

	</div>
	<div class='ui styled accordion' style='width:80%; margin-right:1%; float:right;'>
		<div class='title'>
			<i class='dropdown icon'></i>
			<i class='trophy icon'></i>  Pridaj súťaž
		</div>
		<div class='content'>
			<table class='ui compact table' style='border:none'>
				<tbody class='add_user'>
					<?php
					$inst->addCompetition();
					?>
				</tbody>
			</table>
		</div>
	</div>
	<table class="ui selectable table" style="width:80%; margin-right:1%; float:right">
		<thead>
			<tr>
				<th>Názov</th>
				<th>Prihlasovanie do</th>
				<th>Rok</th>
				<th>Pokusy</th>
				<th class="no-sort" style="width:2em">Zmazať</th>
			</tr></thead>
			<tbody>


				<?php 
				if ($link = spoj_s_db()) {
					$sql = "SELECT * FROM competitions ORDER BY year DESC, sign_in_deadline DESC";
					$result = mysql_query($sql, $link);

					while ($row = mysql_fetch_assoc($result)) {
						echo "<tr data-id='".$row["id"]."'>\n";
						echo "<td class='gird_edit' data-type='name'><i class='dropdown icon'></i> ".$row["name"]."</td>\n";
						echo "<td class='gird_edit' data-type='sign_in_deadline'>".$row["sign_in_deadline"]."</td>\n";
						echo "<td class='gird_edit' data-type='year'>".$row["year"]."</td>\n";
						echo "<td class='gird_edit' data-type='measure_count'>".$row["measure_count"]."</td>\n";
						echo "<td class='delete'><a class='delete_button'><i class='remove big icon'></i></div><div class='ui flowing inverted popup top left transition hidden'><h4 class='ui header'>Skutočne zmazať súťaž?</h4><div class='ui positive fluid button gird_delete'>Áno</div></a></td>";
						echo "</tr>\n\n";
						echo "<tr id='expander_".$row["id"]."' style=''><td class='td_expander' colspan='5'>";
						echo "	<div class='ui styled accordion' style='width:100%;'>
						<div class='title'>
							<i class='dropdown icon'></i>
							<i class='trophy icon'></i>  Pridaj výsledok
						</div>
						<div class='content'>
							<table class='ui compact basic table' style='border:none'>
								<tbody class='add_user'>";
									$inst->addScore($row["id"]);


									echo "</tbody>
								</table>
							</div>
						</div>";
						echo "<table class='ui selectable celled table'>";
						$inst->getResults($row["id"]);
						echo "</table>";
						echo "</td></tr>";
					}
				}
				?>



			</tbody>

		</table>
		<script type="text/javascript">
			$('.ui.dropdown').dropdown();
		</script>
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
		textarea.parent().html(""+change+""); // Change the webpage from textarea to text again with new value
		$.post("send.php", { // Send the retrieved data to a script that pushes it to database (SQL UPDATE)
			type1: type,
			id1: id,
			val1:change,
			table1: "competitions",
			id_name1:"id"
		});
	})
}

var update_date_funct = function() {
	var tex = $(this).val(); // Get current value of cell
	var textarea = $("<input type='datetime-local' name='deadline' required='' value='"+text+"'>"); // Create a textfield with the current value
	$(this).html(textarea); // Render the datetime on webpage
	var parent = $(this).parent(); // Get the parent of the cell = table row containing user id
	textarea.focus(); // Set the focus on the created datetime
	$(this).unbind(); // Disable the click function on the datetime so the cursor won't move to the beginning everytime you click on it
	textarea.blur(function(){ // When you click outside of the the datetime (the datetime loses focus)
		$('.gird_edit_date').unbind(); // Flush all binded events
		$('.gird_edit_date').bind({ // Rebind the click function
			click: update_funct
		});
		var type = $(this).parent().data("type"); // Get the column name of edited field
		var id = $(this).parent().parent().data("id"); // Get the id of user whose data was changed
		var change = parent.find("#gird_val").val(); // Get the new value
		textarea.parent().html(""+change+""); // Change the webpage from datetime  to text again with new value
		$.post("send.php", { // Send the retrieved data to a script that pushes it to database (SQL UPDATE)
			type1: type,
			id1: id,
			val1:change,
			table1: "competitions",
			id_name1:"id"
		});
	})
}

var delete_funct = function() {
	var row=$(this).parent().parent().parent().parent();
	var id = row.data("id");
	$("#expander_"+id).remove();
	row.remove();

	$.post("delete.php", { // Send the retrieved data to a script that pushes it to database (SQL UPDATE)
		id1:id,
		table1: "competitions",
		id_name1: "id"
	});
}
var expand_funct = function() {
	var row=$(this);
	var id = row.data("id");
	row.toggleClass("active");
	$("#expander_"+id).find(".td_expander").slideToggle("slow").toggleClass("active");
}
$( document ).ready(function() {
/*	$(".add_user form").on('submit', function(e) {
        e.preventDefault();
        var pom = parseInt($(this).parent().parent().parent().parent().parent().parent().attr("id").split("_")[1]);
        alert(pom);
        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#form_output").html(data);
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });*/
	$('.ui.accordion')
	.accordion()
	;
	$("td.td_expander").hide();
	$("tr[data-id]").bind({
		click: expand_funct
	});
	//$('.gird_edit').bind({ // Bind the update function on webpage load 
	//	click: update_funct
	//});
	//$('.gird_edit_date').bind({ // Bind the update function on webpage load 
	//	click: update_date_funct
	//});
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
	$('.ui.dropdown').dropdown();
	$("#postid").hide();
});

</script>
</html>
