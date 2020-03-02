<?PHP
	/**
	 ** 
	 **/
 	//$root_dir = $_SERVER['DOCUMENT_ROOT'];
 	$this_page = $_SERVER['PHP_SELF'];
 	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
 	
 	//$root_dir = dirname($this_page);
   include_once $root_dir . "/controllers/StatusController.php";
   $search_name = $_GET['name'];
   $action_name = $_GET['search'];
	echo "<HEAD>";
	echo "<TITLE>MVC Demo Gordon Hennesy 2-26-2020 Status Page</TITLE>";
	echo "</HEAD>";	
	echo "<center><H4>statuses</H4></center>";
	$controller = new StatusController();
	//echo "statuses NEW CONTROLLER<br>";
	$controller->run();
?>