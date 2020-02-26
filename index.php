<?PHP

	echo "MVC Demo Gordon Hennesy 2-26-2020<br>";
	$connection_string = "host=localhost port=5432 dbname=demo user=postgres password=OCCU2020";
	$conn = pg_connect ( $connection_string );
	$result = pg_query($conn, "select * from name");
	while( $result_arr = pg_fetch_array($result)) {
		var_dump($result_arr);
	}
	//var_dump(pg_fetch_all($result));


?>
