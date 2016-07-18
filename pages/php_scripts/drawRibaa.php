<?php

	session_start();
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	if (!$db){
		die("no connection to database ". pg_last_error());
	}
	
	$Geometry=pg_escape_string($_POST['Geometry']);
	$userID=$_SESSION['userID'];

	$query = "INSERT INTO ribaa (geometry) VALUES('" . $Geometry ."')";
	$result = pg_query($query);
	if (!$result) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}

	$querylog = "INSERT INTO operation (utilisateur_id, description, time, entite_id, table_op) VALUES('" . $userID . "', 'Ribaa dessinée', localtimestamp, currval('ribaa_id_seq'), 'ribaa')";
	$resultlog = pg_query($querylog);
	if (!$resultlog) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}

	pg_close();
?> 
