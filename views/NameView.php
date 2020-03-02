<?PHP
	$root_dir = dirname($_SERVER['SCRIPT_FILENAME']);
	include_once $root_dir . "/views/View.php";
	include_once $root_dir . "/models/NameModel.php";

	class NameView extends View {
		
		function __construct() {
			$this->model = new NameModel();
		}
		function print() {
			$this->model->print();	
		}
		function render($name, $edit_name, $duplicate_name) {
			if (trim($edit_name) !='')
				$search_name = trim($edit_name);
			else if (trim($duplicate_name) !='')
				$search_name = trim($duplicate_name);
			else
				$search_name = trim($name);
			$values = $this->model->get($search_name);
			?>
			<table align=center>
			<form name=EditNames border=1>
			<?php
				$index = 0;
			foreach($values as $row) {
				?>
				<tr>
				<th></th>
				<?php
				foreach($row as $name=>$value) {
					echo "<th style=\"1px solid black;\">$name</th>";
				}
				?>
				</tr>
				<tr>
				<?php
				$name_value = $row['name'];
				if ($name_value == $edit_name) {
				echo "<td><input type=submit 
				name=Update 
				value=\"Update {$row['name']}\"></td>";
				} else {
				echo "<td><input type=submit 
				name=Edit 
				value=\"Edit $name_value\"></td>";
				}
				foreach($row as $name=>$value) {
					if ($name_value == $edit_name) {
						echo "<td><input name=$name value='$value'></td>";
					} else {
						echo "<td><input name=$name value='$value' disabled=true></td>";
					}
				}
				echo "<td><input type=submit 
				name=Duplicate 
				value=\"Duplicate {$row['name']}\"></td>";
				echo "<td><input type=submit 
				name=Delete 
				value=\"Delete {$row['name']}\"></td>";
				?>
				</tr>
				<?php
				$index++;
			}
			?>
				<tr>
				<td colspan=7 align=center>
				<input type=submit 
				name="Insert" 
				value="New Row">
				</td>
				</tr>
				</form>
				</table>
			<?php
			
		}
		function render_search($name){
			$search_name = trim($name);
			?>
				<h1 align=center>Search Name View</H1></p>
				<center>
				<table align=center>
				<form>
				<?php
				echo "Search Name<input type = text name=name value='$search_name'>";
				?>
				<tr><td><input type=submit name=search value="Search">
				<input type=submit name=reset value="Reset">
				</td></tr>
				</form>
				</table>
				</center>

				<?php
		}
		function render_insert() {
			$values = $this->model->get();
			?>
			<table align=center>
			<form name=EditNames border=1>
			<?php
				$index = 0;
			    $row = $values[0];
				?>
				<tr>
				<th></th>
				<?php
				foreach($row as $name=>$value) {
					echo "<th style=\"1px solid black;\">$name</th>";
				}
				//}
				?>
				</tr>
				<?php
				echo "<td><input type=submit 
				name=Save 
				value=\"Save\"></td>";
				foreach($row as $name=>$value) {
						echo "<td><input name=$name value=''></td>";
				}
				//}
				?>
				<tr>
				<td colspan=5 align=center>
				<input type=submit 
				name="Insert" 
				value="New Row">
				</td>
				</tr>
				</form>
				</table>
			<?php
		}
	}
?>
