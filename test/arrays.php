<?php 
	include_once("../function/db_info.php");

	$arrayName = array();
	$count =0;
	for($i =0; $i<4; $i++)
		for($j =0; $j<15; $j++)
		$arrayName[$i][$j] = ++$count;
		
	echo "array loaded <br/>";
	for($i =0; $i<count($arrayName); $i++){
		for($j =0; $j<count($arrayName[0]); $j++)
			echo $arrayName[$i][$j]." ";
		echo "<br/>";
	}
	
	$table_name = "censpro_education";
	echo "test: printing data types of the columns of the table: $table_name <br/>";
	$column_types = getTableColumnTypes($table_name);
	for($i =0; $i < count($column_types); $i++)
		echo $column_types[$i]."<br/>";
	
?>