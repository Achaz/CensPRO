<?php
	include_once("../function/core.php");
	
	
	$table = "censpro_religion";
	$query = "select * from $table";
	echo $query;
	
	
	$result = db_select($query, $table);
	
	for($i =0; $i<count($result); $i++){
		echo "</br>";
		for($j =0; $j<count($result[0]); $j++)
			echo $result[$i][$j]," ";	
	}
?>