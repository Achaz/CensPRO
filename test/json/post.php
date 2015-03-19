<?php
	//$arrr = array(1 => "Ronald", 2 => "Kasagga");
	// $arr = array();
    // $arr['one'] = "one value here";
    // $arr['two'] = "second value here";
    // $arr['three'] = "third value here";
// 
    // $redirect = "get.php?".http_build_query($arr);
    // header( "Location: $redirect" );	
    
    $myarray[] = 500;
    $myarray[] = "hello world";
    $myjson = json_encode($myarray);
?>

<form name="input" action="get.php">
    <input type="hidden" name="json" value="<?php echo $myjson ?>" />
    <input type="submit" value="Submit">
</form>

<!-- <html>
	<head>get test</head>
	<body>
		<form method = "post" action = "get.php">
			<input type = "hidden" name = "input_name" value = "<?php print_r($arrr); ?>" />
			<input type = "submit" />
		</form>
	</body>
	
</html> -->