<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
	include_once $root_dir . "/controllers/Controller.php";
	include_once $root_dir . "/views/NameView.php";
	include_once $root_dir . "/models/NameModel.php";
	class NameController extends Controller {
		function __construct() {
			//echo "Construct NAME Controller<br>";	
			$this->view = new NameView();
			$this->model = new NameModel();
		}
		function print() {
			echo "print Name Controller<br>";	
			$this->view->print();
		}
		function render() {
		   $search_name = $_GET['name'];
   		$action_name = $_GET['search'];
   		$action_edit = $_GET['Edit'];
   		//echo "$action_edit<br>";
   		$action_dup = $_GET['Duplicate'];
   		$action_save = $_GET['Save'];
   		$address = $_GET['address'];
   		$notes = $_GET['notes'];
   		$values = array();
   		$values['address']=$address;
   		$values['notes']=$notes;
   		if ($action_edit) {
   			$edit_name_arr = explode('Edit ',$action_edit);
   			$edit_name = $edit_name_arr[1];
   			$edit_name = trim($edit_name);
   		//echo "EDIT NAME $edit_name<br>";
  			}
   		if ($action_dup) {
   			$duplicate_name_arr = explode('Duplicate ',$action_dup);
   			$duplicate_name = $duplicate_name_arr[1];
   			$duplicate_name = trim($duplicate_name);
   		//echo "DUP NAME $duplicate_name<br>";
  			}
  			if ($action_save) {
   			$save_name_arr = explode('SAVE ',$action_save);
   			$save_name = $save_name_arr[1];
   			$save_name = trim($save_name);
   		//echo "Save NAME $save_name<br>";
   		
   			$this->model->save($search_name,$values);
  			}
   		$action_compare = $_GET['Compare'];

			//echo "render Name Controller $search_name<br>";	
			$this->view->render_search($search_name);
			$this->view->render($search_name, $edit_name, $duplicate_name);
		}
	}
//echo "HERE Name Controller$root_dir<br>";
?>