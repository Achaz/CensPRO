<?php
	include_once("../function/core.php");
	//testing query builder
	$table_name = "censpro_education";
	$values = array( 0 => 3, 1 => "Bsc Information Technology", 2 => 2013, 3 => "Makerere University" );
	
	echo "testing 'buildInsertQuery()' using table $table_name <br/	>";
	$query = buildInsertQuery($table_name, $values);
	echo $query;
	
	echo "<br/> table structure.";
	$struct = getTableColumnTypes($table_name);
	for($i =0; $i<count($struct); $i++)
		echo "<br/>".$struct[$i];
	
	//testing actual insert
	//testing query builder
	$table_name = "censpro_country";
	$values = array( 0 => 0, 1 => "Tanzania");
	
	echo "testing 'db_insert()' using table $table_name <br/>";
	$query = db_insert($table_name, $values);	
	echo $query;
	
?>