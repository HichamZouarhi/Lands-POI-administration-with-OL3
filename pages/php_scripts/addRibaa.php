<?php

	session_start();
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	if (!$db){
		die("no connection to database ". pg_last_error());
	}

	$ID_Expropriation=pg_escape_string($_POST['ID_Expropriation']);
	$Type=pg_escape_string($_POST['Type']);
	$Num_Foncier=pg_escape_string($_POST['Num_Foncier']);
	$Superficie=pg_escape_string($_POST['Superficie']);
	$Description=pg_escape_string($_POST['Description']);
	$Commune=pg_escape_string($_POST['Commune']);
	$Province=pg_escape_string($_POST['Province']);
	$Region=pg_escape_string($_POST['Region']);
	$wkt=pg_escape_string($_POST['Geometry']);
	$userID=$_SESSION['userID'];

	$query = "insert into ribaa (id_expropriation, type, num_foncier, superficie, description, commune, province, region, geometry ) values ('".$ID_Expropriation."', '".$Type."', '".$Num_Foncier."', '".$Superficie."', '".$Description."', '".$Commune."', '".$Province."', '".$Region."', ST_GeomFromText('".$wkt."'))";
	$result = pg_query($query);
	if (!$result) {
		die("Error with query: " . pg_last_error());
	}

	$querylog = "INSERT INTO operation (utilisateur_id, description, time, entite_id, table_op) VALUES('" . $userID . "', 'Ribaa ajoutée', localtimestamp, currval('ribaa_id_seq'), 'ribaa')";
	$resultlog = pg_query($querylog);
	if (!$resultlog) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}

	pg_close();
?> 
