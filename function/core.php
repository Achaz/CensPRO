<?php 
	include_once("db_info.php");
	
	function buildInsertQuery($table_name, $values){
		//$table_append = "censpro_";
		$value_list = "";
		$datatype_list = getTableColumnTypes($table_name);
		
		//for this to work, values must be in an order that complies with the database etructure.
		for($i = 0; $i<count($values); $i++){
			if(strpos($datatype_list[$i], "int(11)") !== false || strpos($datatype_list[$i], "BLOB") !== false)
				$value_list.=$values[$i].", ";
			else
				$value_list.="'".$values[$i]."', ";
		}
		$value_list = removeLastOccurenceOfChar(",", $value_list);
		
		$query = "INSERT INTO $table_name VALUES ($value_list)";
		
		return $query;
	}
	
	function db_insert($table_name, $values){				
		$query = buildInsertQuery($table_name, $values);		
		$result = db_query($query);
		return $result;	
	}
	
	function db_query($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		//echo $query;
		$db_query = mysqli_query($conn, $query);
		if($db_query)
			return true;
		else return false;	
	}
	
	function db_select1($table, $criteria, $value, $data_type){
		if($data_type != "int")
			$value = "'$value'";
		$db = new ConnectDB();
		$conn = $db->connect();
		$no_table_columns = countColumns($table);
		
		$query = "SELECT * FROM $table ";//WHERE $criteria = $value";
		$select_result = array();
		$count = 0;
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				for ($i=0; $i<$no_table_columns; $i++)
					$select_result[$count][$i] = $row[$i];
				$count++;
			}
		}		
		return $select_result;		
	}
	
	function db_select($query, $table){
		
		$db = new ConnectDB();
		$conn = $db->connect();
		//$no_table_columns = countColumns($table);
		
		$select_result = array();
		$count = 0;
		//echo $query;
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$rows = mysqli_num_rows($result);
			$columns = mysqli_num_fields($result);
			
			for($j =0; $j<$rows; $j++){
				$row = mysqli_fetch_array($result);
				for ($i=0; $i<$columns; $i++)
					$select_result[$j][$i] = $row[$i];
			}
			/*
			while($row = mysqli_fetch_array($result)){
				for ($i=0; $i<$no_table_columns; $i++)
					$select_result[$count][$i] = $row[$i];
				$count++;
			}*/			
		}		
		return $select_result;		
	}
	
	function db_select2($query){
		
		$db = new ConnectDB();
		$conn = $db->connect();
		//$no_table_columns = countColumns($table);
		
		$select_result = array();
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$rows = mysqli_num_rows($result);
			$columns = mysqli_num_fields($result);
			
			for($j =0; $j<$rows; $j++){
				$row = mysqli_fetch_array($result);
				for ($i=0; $i<$columns; $i++)
					$select_result[$j][$i] = $row[$i];
			}	
		}		
		return $select_result;		
	}
	
	
	
	/*
		//testing db_select()
	 * $res = db_select("censpro_country", "", "", "");
		$res_size = count($res);
		$res_inner = count($res[0]);
		echo "censpro_country has $res_size results with $res_inner inner contents.<br/>";
		
		if(count($res_size) > 0){
			for($i=0; $i<$res_size; $i++){
				for($j = 0; $j<$res_inner; $j++)
					echo $res[$i][$j]." ";
				echo "<br/>";
			}
		}
	 //* */
	
	
	
	
?>
