<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
	include_once $root_dir . "/models/Model.php";
	
	class NameModel extends Model {
//		var $model;
		
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
			$result = pg_query($this->conn, "select name, time_created, address, notes from ". $this->table .";");
			while ($row = pg_fetch_assoc($result)) {
				foreach($row as $name=>$value) {
				echo "$name $value<br>";	
				//echo $row['name'];	
				//echo $row['time_created'];	
				}
			}
		}
		function get($search_name) {
			//echo "get Name Model$search_name<br>";
			if ($search_name != '') {
				$where_clause = " WHERE name = '$search_name'";
				$sql = "select * from ". $this->table ." $where_clause;";
			} else {
				$sql = "select * from ". $this->table .";";
			}
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
		function insert($values) {
			$sql = "INSERT INTO ". $this->table ."values()";
			$result = pg_query($this->conn, $sql);
		}
		function duplicate($values, $new_name) {
		}
		function save($old_name, $values) {
			$sql = "UPDATE ". $this->table ." SET ";
			foreach($values as $name=>$value) {
				$sql .= " $name = '$values' ";
			}

			$sql .= " WHERE name = '$old_name';";
			echo "SQL $sql<br>";
			
			$result = pg_query($this->conn, $sql);
		}
	}
//echo "HERE Name NameModel$root_dir<br>";
?>
