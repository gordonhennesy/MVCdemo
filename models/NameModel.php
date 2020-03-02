<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
	include_once $root_dir . "/models/Model.php";
	
	class NameModel extends Model {
		/**
		 * This is the Model which implements (CRUD)
		 * create, read, update, and delete
		 * using a PostgreSQL database as the data store
		 */		
		function __construct() {
			$this->table = 'name';
			$this->connection_string = "host=localhost port=5432 dbname=demo user=postgres password=OCCU2020";
			$this->conn = pg_connect ( $this->connection_string );

		}
		function print() {
			$result = pg_query($this->conn, "select name, time_modified, address, notes from ". $this->table .";");
			while ($row = pg_fetch_assoc($result)) {
				foreach($row as $name=>$value) {
					echo "$name $value<br>";
				}
			}
		}
		/**
		 * Get (Read of CRUD)
		 */
		function get($search_name='') {
			if ($search_name != '') {
				$where_clause = " WHERE name = '$search_name'";
				$sql = "select * from ". $this->table ." $where_clause;";
			} else {
				$sql = "select * from ". $this->table .";";
			}
			$result = pg_query($this->conn, $sql);
			$values = array();
			while( $row = pg_fetch_assoc($result)) {			
				array_push ($values,$row);
			}
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
			$result = pg_query($this->conn, $sql);
		}
		/**
		 * Save (Update of CRUD)
		 */
		function save($old_name, $values) {
			$sql = "UPDATE ". $this->table ." SET ";
			foreach($values as $name=>$value) {
				$sql .= " $name = '$value', ";
			}
			$sql .= " time_modified = NOW() ";

			$sql .= " WHERE name = '$old_name';";
			
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
			$pos = stripos ( $old_name , '(dup)');
			echo "pos $pos<br>";
			}
			
			foreach($values as $name=>$value) {
				$sql .= " $name = '$value', ";
			}
			$sql .= " time_modified = NOW() ";

			$sql .= " WHERE name = '$old_name';";
			
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
?>
