<?php
	include_once("../function/android.php");
	//Get the json string from the parameter in the request body     
     $jsonStringRaw = $_REQUEST["household"]; // *******************************	I DON'T KNOW WHAT YOU SENT

     //Remove any redundant slashes in the string( this part might bring issues, let BISHAKA know if any )
     $cleanedString = stripcslashes($jsonStringRaw);

     //decode the json string, this returns an array object that is simillar to the object passed in the json string(I HOPE)
     $master_array = json_decode($cleanedString, TRUE);	
	
	$remittance = $master_array['remits'];
   $remittance_source = $master_array['remerc'];
   $energy_source = $master_array['energy'];
   $enterprise_name = $master_array['ent'];
   $enterprise_description = $master_array['entdesc'];
   $water_source = $master_array['water'];
   $wall_material = $master_array['wall'];
   $roof_material = $master_array['roof'];
   $floor_material = $master_array['floor'];
   $toilet_type = $master_array['toilet'];
   $dwelling_type = $master_array['dwelling'];
   $distance_police = $master_array['distpol'];
   $distance_public_health = $master_array['pubhealth'];
   $distance_private_health = $master_array['prihealth'];
   $household_head_name = $master_array['hname'];
   $district = $master_array['district'];
   $source_of_livelihood = $master_array['livelihood '];    
   $distance_public_primary = $master_array['public_primary'];
   $distance_public_secondary = $master_array['public_secondary'];
   $distance_private_primary = $master_array['private_primary'];
   $distance_private_secondary = $master_array['private_secondary'];
   $farm_district = $master_array['farm_district'];
   $farm_purpose = $master_array['farm_purpose'];
   $farm_location = $master_array['farm_location'];
   $farming_type = $master_array['farm_type'];
   $disposal_type = $master_array['disposal_type'];
   $farm_quantity_produced = $master_array['quantity_produced'];
   // --> YOU MISSED RECORD PERSON.
   
   //multi-valued objects
	$household_members = $master_array['members']; //list
    $household_assets = $master_array['assets']; //list
    
    
   
   //create household---------------------------------------------------------------------------
   $location = "";  //was not sent (not mandatory, but necessary i.e. 'clement hill road, plot 54')
   $record_person_id = 1; //***********************CANNOT BE EMPTY. included in reply during authentication (see authenticate.php)
   $household_id = addHousehold($household_head_name, $location, $district, $record_person_id);
   
   //add enterprises--------------------------------------------------------------------------
   		//was shifted to person, but what's done is done.
   $person_id = getPersonId($household_head_name);
   addPersonalEnterprise($enterprise_name, $enterprise_description, $person_id);
   
   //add members---------------------------------------------------------------------------
   for($i = 0; $i < count($household_members); $i++)//assuming the index is a number and starts from 0
   	addMemberToHousehold($household_members[$i], $household_id);
   
   //add assets---------------------------------------------------------------------------
   $quantity =1;//declared outside because quantity was not sent
   for($i = 0; $i < count($household_assets); $i++)//assuming the index is a number and starts from 0
   	addHouseholdAsset($household_assets[$i], $quantity, $household_id);
   
   //add agriculture---------------------------------------------------------------------------
   		//meant to be repetitive, but it's ok. households usually do one form of farming
   		$comodity_name = "cow"; //*******************name of plant/animal grown/reared in the farm. CANNOT BE EMPTY
   		//PLEASE N0TE "farming_type" IS EITHER 'crop' OR 'livestock'
   		addHouseholdAgriculture($farming_type, $farm_quantity_produced, $farm_purpose, $farm_location, $farm_district, $household_id, $comodity_name);
   		
   //add housing conditions---------------------------------------------------------------------------
   defineHousingConditions($household_id, $occupancy, $energy_source, $water_source, $toilet_facility, $dwelling_type, $roof_material, $floor_material, $wall_material);
   
   //add access to community services---------------------------------------------------------------------------
   defineHouseholdDistanceToCommunityServices($distance_public_health, $distance_private_health, $distance_public_primary, $distance_private_primary, 
   				$distance_public_secondary, $distance_private_secondary, $distance_police, $household_id);
	
	//add kitchen---------------------------------------------------------------------------
	//addHouseholdKitchen($household_id, $kitchen_type); //missing ------?????????????????????	
	
	//add disposal method---------------------------------------------------------------------------
	addHouseholdDisposalMethod($disposal_type, $household_id);
	
	//add remittances---------------------------------------------------------------------------
	addHouseholdRemittance($remittance, $remittance_source, $household_id);
	
	//optional reply to android
	$response["success"] = 1;
	$response["message"] = "HOUSEHOLD ADDED SUCCESSFULLY";
	echo json_encode($response);

?>