<?php
	$username = $_GET['u'];
	$password = $_GET['p'];
	
	if($username == null || $password == null){
		$response["success"] = 0;
	    $response["message"] = "incomplete request";

	    echo json_encode($response);
	}else{
		include("../function/core.php");
		$table = "censpro_record_personnel";
		$query = "SELECT * FROM $table where username = '$username' and password = md5('$password')";
		$result = db_select($query, $table);
		if(count($result) > 0){			
			$response["success"] = 1;
	    	        $response["message"] = "VALID USER";
			$response["auth_id"] = md5($result[0][0]);

	    	echo json_encode($response);
		}else{
		$response["success"] = 0;
	    	$response["message"] = "INVALID USER";

	    	echo json_encode($response);
		}		
	}
	
	
	
?>
