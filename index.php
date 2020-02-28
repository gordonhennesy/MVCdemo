<?PHP
/**
 ** 
 **/
 	//$root_dir = $_SERVER['DOCUMENT_ROOT'];
 	$this_page = $_SERVER['PHP_SELF'];
 	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
 	
 	//$root_dir = dirname($this_page);
   include_once $root_dir . "/controllers/NameController.php";
   $search_name = $_GET['name'];
   $action_name = $_GET['search'];

	echo "MVC Demo Gordon Hennesy 2-26-2020<br>";
	//echo "MVC Demo Gordon Hennesy 2-26-2020$this_page : $root_dir<br>";
	
	$controller = new NameController();
	$controller->render();

?>
