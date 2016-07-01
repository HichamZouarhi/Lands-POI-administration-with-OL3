<?php
$conn = pg_connect ("host=localhost port=5432 dbname=MHAI_DH user=postgres password=P0stgres");
if (!$conn)
{
	die('Error: Could not connect: ' . pg_last_error());
}

$result = pg_query($conn, 'SELECT * FROM expropriation');
if (!$result) {
	die("An error occurred." . pg_last_error());
}

echo '<html><body><table>';

$i = 0;

while ($row = pg_fetch_row($result)) 
{
	echo '<tr>';
	$count = count($row);
	$y = 0;
	while ($y < $count)
	{
		$c_row = current($row);
		echo '<td>' . $c_row . '</td>';
		next($row);
		$y = $y + 1;
	}
	echo '</tr>';
	$i = $i + 1;
}
pg_free_result($result);
echo '</table></body></html>';
?>

