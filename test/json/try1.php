<?php
	$data = array(
				    'userID'      => 'a7664093-502e-4d2b-bf30-25a2b26d6021',
				    'itemKind'    => 0,
				    'value'       => 1,
				    'description' => 'Boa saudaÁ„o.',
				    'itemID'      => '03e76d0a-8bab-11e0-8250-000c29b481aa'
				 );
				 
				 
	$json = json_encode($data);
	
	$ch = curl_init('http://api.local/rest/users');                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	    'Content-Type: application/json',                                                                                
	    'Content-Length: ' . strlen($data))                                                                       
	);                                                                                                                   
	 
	$result = curl_exec($ch);

?>