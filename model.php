<?php
require_once('database.php');
class CrudOperation extends Database{
	
	// Insert method
	public function insert($table, $data){
		// insert into table_name (id,name,email) values ('','','');
		$sql ="";
		$sql .= "INSERT INTO ".$table;
		$sql .= " (".implode(", ", array_keys($data)).") VALUES ";
		$sql .= "('".implode("', '", array_values($data))."')";
		$query = mysqli_query($this->con,$sql);
		if ($query) {
			return true;
		}
		else
		{
			return false;
		}
	}

	// select_all method
	public function select_all($table){
			$sql ="";
			$array = array();
			$sql .=" SELECT * FROM ".$table;
			$query = mysqli_query($this->con,$sql);
			while($row = mysqli_fetch_assoc($query)):
				$array[] = $row;
			endwhile;
			return $array;

	}

	// select_where method
	public function select_where($table,$where){
		$sql ="";
		$condition="";
		$array = array();
		foreach ($where as $key => $value) {
			$condition .= $key .=" ='".$value."'";
		}
		$sql .="SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$array[] = $row;
		}
		return $array;
	}

	// update method
	public function update($table,$data,$where){
		// Update table_name set field1='', field2='' where user_id=''; 
		$sql = "";
		
		$condition="";
		foreach ($data as $key => $value) {
			$sql .= $key .="='".$value."', ";
		}
		$sql = substr($sql, 0,-2);  

		foreach ($where as $key => $value) {
			$condition .= $key.="='".$value."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql = " UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		if ($query) {
			return true;
		}
	}


	// Delete method
	public function delete($table,$where){
		$sql = "";
		$condition="";
		foreach ($where as $key => $value) {
			$condition .= $key .="='".$value."' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "DELETE FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con, $sql);
		if ($query) {
			return true;
		}
	}
}
$obj = new CrudOperation;
