<?php
	
	session_start();
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	
	if (!$db){
		die("no connection to database ". pg_last_error());
	}
	
	$username=pg_escape_string($_POST['username']);
	$password=pg_escape_string($_POST['password']);
	
	$query = "SELECT * FROM utilisateur WHERE username = '". $username ."' AND password = md5('". $password ."');";
	$result = pg_query($query);
	
	$_SESSION['userID'] = pg_fetch_result($result,0,'id');
	$_SESSION['userName'] = pg_fetch_result($result,0,'nom');
	$_SESSION['userFunction'] = pg_fetch_result($result,0,'fonction');
	
	if(pg_num_rows($result)!=1) {
		// do error stuff
		echo "error";
	} else {
		// user logged in
		echo "success";
	}
	pg_close();
?>
