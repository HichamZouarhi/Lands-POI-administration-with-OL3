<?php
	
	$db = pg_connect('host=localhost dbname=MHAI_DH user=postgres password=P0stgres');
	
	if (!$db){
		die("no connection to database ". pg_last_error());
	}
	$query1 = "create or replace view lands as select a.date_correspondance, count(b.id) from expropriation as a, terrain as b where a.id=b.id_expropriation group by a.date_correspondance;";
	$result1 = pg_query($query1);
	if (!$result1) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}

	$query2 = "create or replace view exprops_lands as select a.date_correspondance as day, a.count as exprops, b.count as lands from expropriations as a left outer join lands as b on (a.date_correspondance=b.date_correspondance);";
	$result2 = pg_query($query2);
	if (!$result2) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}

	$query3 = "create or replace view ribaas as select a.date_correspondance, count(b.id) from expropriation as a, ribaa as b where a.id=b.id_expropriation group by a.date_correspondance;";
	$result3 = pg_query($query3);
	if (!$result3) {
		$errormessage = pg_last_error();
		echo "Error with query: " . $errormessage;
		exit();
	}

	$query = "select a.day, a.exprops, a.lands, b.count as estates from exprops_lands as a left outer join ribaas as b on (a.day=b.date_correspondance);";
	$result = pg_query($query);
	
	$arr=pg_fetch_all($result);
	echo json_encode($arr);

	pg_close();
?>
