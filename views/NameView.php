<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
//   require_once ("Controller.php");
echo "$root_dir<br>";
	include_once $root_dir . "/views/View.php";
	include_once $root_dir . "/models/NameModel.php";
	include_once $root_dir . "/style.css";

	class NameView extends View {

		
		function __construct() {
			$this->model = new NameModel();
			echo "Construct NAMEVIEW<br>";
		}
		function print() {
			echo "print NAMEVIEW<br>";
			$this->model->print();	
		}
		function render($name, $edit_name, $duplicate_name) {
			//echo "print NAMEVIEW<br>";
			$search_name = trim($name);
			echo "$edit_name<br>";
			echo "$duplicate_name<br>";
			$values = $this->model->get($search_name);
			//print_r($values);
			?>
			<table align=center>
			<form name=EditNames border=1>
			<?php
				$index = 0;
			foreach($values as $row) {
				?>
				<tr>
				<th>
				<?php
				foreach($row as $name=>$value) {
					echo "<th style=\"1px solid black;\">$name</th>";
				}
				?>
				</tr>
				<tr>
				<?php
				//print_r($row);
				$name_value = $row['name'];
				//echo "<td>$name_value $edit_name</td>;"
				if ($name_value == $edit_name) {
				echo "<td><input type=submit 
				name=Save 
				value=\"Save {$row['name']}\"></td>";
				} else {
				echo "<td><input type=submit 
				name=Edit 
				value=\"Edit {$row['name']}\"></td>";
				}
				foreach($row as $name=>$value) {
					if ($name_value == $edit_name) {
						echo "<td><input name=$name value=$value></td>";
					} else {
						echo "<td>$value</td>";
					}
				}
				echo "<td><input type=submit 
				name=Duplicate 
				value=\"Duplicate {$row['name']}\"></td>";
				?>
				</tr>
				<?php
				$index++;
			}
			?>
				<tr>
				<td colspan=6 align=center>
				<input type=submit 
				name="Insert" 
				value="New Row">
				</td>
				</tr>
				</form>
				</table>
			<?php
			//echo "render<br>";
			
		}
		function render_search($name){
			$search_name = trim($name);
			?>
				<h1 align=center>Search Name View</H1></p>
				<center>
				<table align=center>
				<form>
				Search Name<input type = text name=name value="<?php $search_name ?>">
				<tr><td><input type=submit name=search value="Seaarch">
				<input type=submit name=reset value="Reset">
				</td></tr>
				</form>
				</table>
				</center>

				<?php
//			echo "HERE Name NAMEVIEW$root_dir<br>";
		}
	}
			?>