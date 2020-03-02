<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
	include_once $root_dir . "/models/Model.php";
	
	class NameModel extends Model {
//		var $model;
		/**
		 * Get (Read of CRUD)
		 * create, read, update, and delete
		 */		
		function __construct() {
			$this->table = 'name';
			//echo "Construct NameModel<br>";
			//echo "MVC Demo Gordon Hennesy 2-26-2020<br>";
			$this->connection_string = "host=localhost port=5432 dbname=demo user=postgres password=OCCU2020";
			$this->conn = pg_connect ( $this->connection_string );
			//echo "MVC Demo Gordon Hennesy 2-26-2020 **".$this->conn."**<br>";

		}
		function print() {
			echo "print Name Model<br>";
			$result = pg_query($this->conn, "select name, time_modified, address, notes from ". $this->table .";");
			while ($row = pg_fetch_assoc($result)) {
				foreach($row as $name=>$value) {
				echo "$name $value<br>";	
				//echo $row['name'];	
				//echo $row['time_modified'];	
				}
			}
		}
		/**
		 * Get (Read of CRUD)
		 */
		function get($search_name='') {
			//echo "get Name Model$search_name<br>";
			if ($search_name != '') {
				$where_clause = " WHERE name = '$search_name'";
				$sql = "select * from ". $this->table ." $where_clause;";
			} else {
				$sql = "select * from ". $this->table .";";
			}
			//echo "$sql<br>";

			$result = pg_query($this->conn, $sql);
			//echo "$result<br>";
			$values = array();
			while( $row = pg_fetch_assoc($result)) {			
				//$values = array_merge ($values,$row);
				//$values = array_merge ($values,$row);
				array_push ($values,$row);
				//print_r($row);
			}
			//print_r($values);
			return $values;
		}
		/**
		 * Insert (Create of CRUD)
		 */
		function insert($insert_name, $values) {
			$sql = "INSERT INTO ". $this->table ."(";
			$sql .= "name, ";
			foreach($values as $name=>$value) {
				$sql .= " $name, ";
			}
			$sql .= "time_modified";
			$sql .= ") ";
			$sql .= "values(";
			$sql .= " '$insert_name', ";
			foreach($values as $name=>$value) {
				$sql .= "  '$value', ";
			}
			$sql .= " NOW() ";
			$sql .= " )";
			echo "SQL $sql<br>";
			$result = pg_query($this->conn, $sql);
			return;
		}
		function duplicate($old_name, $new_name, $values) {
			$sql = "INSERT INTO ". $this->table ." ( name,";
			foreach($values as $name=>$value) {
				$sql .= " $name, ";
			}
			$sql .= " time_modified) ";
			$sql .= " SELECT '$new_name', ";
			foreach($values as $name=>$value) {
				$sql .= " $name,  ";
			}
			$sql .= " NOW() ";
			$sql .= " from ". $this->table ."			 ";
			$sql .= " WHERE name = '$old_name';";
			echo "SQL $sql<br>";
			$result = pg_query($this->conn, $sql);
		}
		/**
		 * Save (Update of CRUD)
		 */
		function save($old_name, $values) {
			$sql = "UPDATE ". $this->table ." SET ";
			foreach($values as $name=>$value) {
				$sql .= " $name = '$value', ";
//				echo " $name = '$value', <br>";
			}
			$sql .= " time_modified = NOW() ";

			$sql .= " WHERE name = '$old_name';";
			//echo "SQL $sql<br>";
			
			$result = pg_query($this->conn, $sql);
		}
		/**
		 * Update (Update of CRUD)
		 */
		function update($old_name, $new_name, $values) {
			$sql = "UPDATE ". $this->table ." SET ";
			$new_name = $values['name'];
			//print_r($values);
			if ($old_name=='Gordon+(dup)') {
				$sql .= " name = '$new_name', ";
			}
			
			foreach($values as $name=>$value) {
				$sql .= " $name = '$value', ";
//				echo " $name = '$value', <br>";
			}
			$sql .= " time_modified = NOW() ";

			$sql .= " WHERE name = '$old_name';";
			echo "SQL $sql<br>";
			
			$result = pg_query($this->conn, $sql);
		}
		/**
		 * Delete (Delete of CRUD)
		 */
		function delete($old_name) {
			$sql = "DELETE FROM  ". $this->table ."";
			$sql .= " WHERE name = '$old_name';";			
			$result = pg_query($this->conn, $sql);
		}
	}
//echo "HERE Name NameModel$root_dir<br>";
?>
