<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
	include_once $root_dir . "/controllers/Controller.php";
	include_once $root_dir . "/views/NameView.php";
	include_once $root_dir . "/models/NameModel.php";

	/**
	 * This is the Controller which implements (CRUD)
	 * create, read, update, and delete
	 * using a PostgreSQL database as the data store
	 */

	class NameController extends Controller {
		function __construct() {
			$this->view = new NameView();
			$this->model = new NameModel();
		}
		function print() {
			echo "print Name Controller<br>";	
			$this->view->print();
		}
		function run() {
			$search_name = $_GET['name'];
			$action_name = $_GET['search'];
			$action_edit = $_GET['Edit'];
			$action_dup = $_GET['Duplicate'];
			$action_save = $_GET['Save'];
			$action_update = $_GET['Update'];
			$action_insert = $_GET['Insert'];
			$action_delete = $_GET['Delete'];
			$action_reset = $_GET['reset'];
			$address = $_GET['address'];
			$name = $_GET['name'];
			$notes = $_GET['notes'];
			$values = array();
			$new_name = $name;
			$values['address']=$address;
			$values['notes']=$notes;
			if ($action_edit) {
				$edit_name_arr = explode('Edit ',$action_edit);
				$edit_name = $edit_name_arr[1];
				$edit_name = trim($edit_name);
			}

			if ($action_dup) {
				$duplicate_name_arr = explode('Duplicate ',$action_dup);
				$duplicate_name = $duplicate_name_arr[1];
				$duplicate_name = trim($duplicate_name);
				$old_name =$search_name;
				$new_name = $duplicate_name . " (dup)";
				$this->model->duplicate($duplicate_name, $new_name, $values);
			}
			if ($action_insert) {
				$this->view->render_insert();
				return;
			}
			if ($action_save) {
				$save_name_arr = explode('SAVE ',$action_save);
				$save_name = $save_name_arr[1];
				$save_name = trim($save_name);
				$this->model->insert($search_name,$values);
			}
			if ($action_update) {
				$update_name_arr = explode('Update ',$action_update);
				$update_name = $update_name_arr[1];
				$update_name = trim($update_name);
				$values['name']=$name;	
				$this->model->update($update_name, $new_name, $values);
			}
			if ($action_delete) {
				$delete_name_arr = explode('Delete ',$action_delete);
				$delete_name = $delete_name_arr[1];
				$delete_name = trim($delete_name);
				$this->model->delete($delete_name);
			}

  			if ($action_reset)	$search_name ='';
			$this->view->render_search($search_name);
			$this->view->render($search_name, $edit_name, $duplicate_name);
		}
	}	
?>
