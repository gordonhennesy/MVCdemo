<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
	include_once $root_dir . "/models/Model.php";
	
	class StatusModel extends Model {
		function __construct() {
			$this->table = 'statuses';
			$this->connection_string = "host=localhost port=5432 dbname=demo user=postgres password=OCCU2020";
			$this->conn = pg_connect ( $this->connection_string );
		}
		function get() {
			$sql = "SELECT * FROM ". $this->table . ";";
			$result = pg_query($this->conn, $sql);
			$values = array();
			while( $row = pg_fetch_assoc($result)) {
				array_push ($values,$row);
			}
			return $values;
		}
	}
