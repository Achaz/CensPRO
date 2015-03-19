<?php  

	//connect to the database 
	include_once("../db/connect.php");
	include_once("../function/db_info.php");
	if ($_FILES['csv']['size'] > 0) { 
		
		//get table name
		$table_name = $_REQUEST['table_name'];
		$count_of_expected_columns = countTableColumns($table_name);
		$i = 0;
		
	    //get the csv file 
	    $file = $_FILES['csv']['tmp_name']; 
	    $handle = fopen($file,"r");
	    
	    //loop through the csv file and insert into database 
	    do { 
	        if ($data[0]) {
	        	$db = new ConnectDB();
				$conn = $db->connect();
				
	        	$qry = "INSERT INTO censpro_$table_name VALUES(0,";
				for($i=0; $i<$count_of_expected_columns; $i++)
					$qry.="'".addslashes($data[0])."',";
				$qry = removeLastOccurenceOfChar(",", $qry);
				$qry.=")";
				
				//echo $qry;
	            
				$query = mysql_query($qry);
			    if(!$query)
					header("Location: ./?e=upload failed&s=. "); 									
	        }
	    } while ($data = fgetcsv($handle,1000,",","'")); 
	
	    header('Location: ./?e=.&s=upload completed successfully'); die; 
	}

?> 

