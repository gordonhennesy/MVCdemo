<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
//   require_once ("Controller.php");
//echo "$root_dir<br>";
	include_once $root_dir . "/views/View.php";
	include_once $root_dir . "/models/StatusModel.php";
//	include_once $root_dir . "/style.css";

	class StatusView extends View {
		function __construct() {
			$this->model = new StatusModel();
			//echo "Construct STATUSVIEW<br>";
		}
		function render() {
			$values = $this->model->get();
			//print_r($values);
			?>
			<table align=center>
			<?php
				$index = 0;
				foreach($values as $row) {
				?>
				<tr>
				<?php
				foreach($row as $name=>$value) {
					echo "<th style=\"1px solid black;\">$name</th>";
				}
				?>
				</tr>
				<tr>
				<?php
				foreach($row as $name=>$value) {
					echo "<td>$value</td>";
				}
				?>
				</tr>
				<?php 
				}
				?>
				</table>
				<?php
		}	
	}