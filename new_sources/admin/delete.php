<?php
function spoj_s_db() {
	if ($link = mysql_connect(':/tmp/mysql51.sock', 'admin_tis_15', '%Quekwyd5')) {
		if (mysql_select_db('tis_projekt_2015', $link)) {
			mysql_query("SET CHARACTER SET 'utf8'", $link); 
			return $link;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

if ($link = spoj_s_db()) {
	$id=$_POST['id1'];
	$table=$_POST['table1'];
	$id_name=$_POST['id_name1'];
	$sql = "DELETE FROM ".$table." WHERE ".$id_name."=".$id;
	$result = mysql_query($sql, $link);
	mysql_close($link); 
}

?>