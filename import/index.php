<?php
	if (empty($_GET['s']))
		header("Location: ./?s=.&e=.");
	
	include("../function/db_info.php");
	
	$success_msg = $_GET['s'];
	$error_msg = $_GET['e'];
	$editable_tables = selectEditableTables();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
		<title>Cens PRO data upload</title> 
	</head> 
	
	<body>	
		<strong style="color: green"><?php echo $success_msg; ?></strong> 
		<strong style="color: red"><?php echo $error_msg; ?></strong> 
				
		<form action="import.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
			<label> Choose table to upload to: </label>
				<select id = "table_name" name= "table_name">
					<?php echo $editable_tables; ?>
				</select><br/><br/>
			<label> Choose your file: </label> <br /> 
				<input name="csv" type="file" id="csv" />
			<input type="submit" name="Submit" value="Submit" /> 
		</form>
		<div>
			<a href = "../"><< back to index</a>
		</div>	
	</body> 
</html> 