<?php
	if($_GET['l'] == '') header("Location: ./?l=0");
	$curr_link = $_GET['l'];
	include_once("functions.php");
	$menu = getMenu($curr_link);
?>
<html>
	
	
	<title>Uganda Census</title>
	<head >
		<center>
			<h3>Uganda Census</h3>
		</center>		
	</head>
	<body>
		<div align = "center" >
			<div style="max-width: 800">
				<div style = "float: left; padding-right: 20px; padding-bottom: 300px">
					 <h3>Menu</h3>
					 <div align="left">
					 	<?php echo $menu;  ?>
					 </div>
				</div>
				<div align="left" style = "padding-bottom: 150px ;border-bottom:dotted; border-bottom-width: 1px; border-top:dotted; border-top-width: 1px">					
					<?php echo getBody($curr_link); ?>
				</div>
				<div style="float: right"><br/> &copy; 2013<br/>All Rights Reserved</div>
			</div>			
		</div>
	</body>
</html>
