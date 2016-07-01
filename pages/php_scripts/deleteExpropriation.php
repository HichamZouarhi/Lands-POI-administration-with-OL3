<?php
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	if (!$db){
		die("no connection to databse ". pg_last_error());
	}
	$ID=pg_escape_string($_POST['ID']);

	$query = "Delete from expropriation where ( id='" . $ID . "')";
        $result = pg_query($query);
        if (!$result) {
            $errormessage = pg_last_error();
            echo "Error with query: " . $errormessage;
            exit();
        }
        pg_close();
?> 
