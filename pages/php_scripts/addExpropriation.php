<?php

	session_start();
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	if (!$db){
		die("no connection to databse ". pg_last_error());
	}
	$Date_Correspondance = $_POST['Date_Correspondance'];
	$Num_BO = pg_escape_string($_POST['Num_BO']);
	$Date_BO = $_POST['Date_BO'];
	$Description = pg_escape_string($_POST['Description']);
	$userID=$_SESSION['userID'];

	$query = "INSERT INTO expropriation(date_correspondance, num_bo, date_bo, description) VALUES('" . $Date_Correspondance . "', '" . $Num_BO . "', '" . $Date_BO ."', '" . $Description . "')";
	$result = pg_query($query);
	if (!$result) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}

	$querylog = "INSERT INTO operation (utilisateur_id, description, time, entite_id, table_op) VALUES('" . $userID . "', 'Nouvelle expropriation', localtimestamp, currval('expropriation_id_seq'), 'expropriation')";
	$resultlog = pg_query($querylog);
	if (!$resultlog) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}
	
	pg_close();
?> 
