<?php
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	if (!$db){
		die("no connection to database ". pg_last_error());
	}
	$ID=pg_escape_string($_POST['ID']);
	$wkt=pg_escape_string($_POST['Geometry']);

	$query = "update ribaa set geometry = ST_GeomFromText('".$wkt."') where ( id='" . $ID . "')";
	$result = pg_query($query);
	if (!$result) {
		die("Error with query: " . pg_last_error());
	}
	pg_close();
?> 
