<?php
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	if (!$db){
		die("no connection to databse ". pg_last_error());
	}
	$ID=pg_escape_string($_POST['ID']);
	$Date_Correspondance=pg_escape_string($_POST['Date_Correspondance']);
	$Num_BO=pg_escape_string($_POST['Num_BO']);
	$Date_BO=pg_escape_string($_POST['Date_BO']);
	$Description=pg_escape_string($_POST['Description']);

	$query = "update expropriation set date_correspondance = '".$Date_Correspondance."', num_bo = '".$Num_BO."', date_bo = '".$Date_BO."', description = '".$Description."' where ( id='" . $ID . "')";
	$result = pg_query($query);
	if (!$result) {
		die("Error with query: " . pg_last_error());
	}
	pg_close();
?> 
