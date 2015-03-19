<?php
    include_once("fetch.php");
	include_once("set.php");
	
    function addPerson($dob, $father_name, $mother_name, $ethnic_name, $religion_name, $record_person_id, $name, $gender, $household_id){
    	$mother_id =0;
		$father_id =0;
		
    	if(!$mother_name=='0') $mother_id = getPersonId($mother_name);
		if(!$father_name=='0') $father_id = getPersonId($father_name);
		if($household_id=='0') $household_id = '';
		$ethnic_id = getEthnicity_id($ethnic_name);
		$religion_id = getReligion_id($religion_name);
		
		$person_id = addPerson1($dob, $father_id, $mother_id, $ethnic_id, $religion_id, $record_person_id, $name, $gender, $household_id);
		return $person_id;
    }
    
    function addPerson1($dob, $father_id, $mother_id, $ethnic_id, $religion_id, $record_person_id, $name, $gender, $household_id){
    	$person_table = "censpro_person";
    	if($mother_id=='0') $mother_id = "NULL";
		if($father_id=='0') $father_id = "NULL";
		if($household_id=='0') $household_id = "NULL";
		
    	$values = array(0 => 0, 1 => $dob, 2 => "NULL", 3 => $father_id, 4 => $mother_id, 
    					5 => $ethnic_id, 6 => $religion_id, 7 => $record_person_id, 8 => $name, 9 => $gender, 10 => "NULL");
		
		db_insert($person_table, $values);
		//$query = "SELECT personId FROM $person_table WHERE dob = '$dob' AND father_id = $father_id AND mother_id = $mother_id AND ethnic_id = $ethnic_id AND religion_id = $religion_id AND record_person_id = $record_person_id AND name = '$name' AND gender = '$gender' AND household_id = '$household_id";
		//$query = "SELECT personId FROM $person_table WHERE dob = '$dob' AND ethnic_id = $ethnic_id AND religion_id = $religion_id AND record_person_id = $record_person_id AND name = '$name' AND gender = '$gender'";
		//$query = "SELECT personId FROM $person_table WHERE dob = '$dob' AND ethnic_id = $ethnic_id AND religion_id = $religion_id AND name = '$name' AND gender = '$gender'";
		$query = "SELECT personId FROM $person_table WHERE dateOfBirth = '$dob' AND name = '$name' AND gender = '$gender'";
		
		$person_id = db_select($query, $person_table);
		
		return $person_id[0][0];
    }
	
	function getPersonId($name){
		$person_table = "censpro_person";
		$query = "SELECT personId FROM $person_table WHERE name = '$name'";
		$person_id = db_select($query, $person_table);
		return $person_id[0][0];
	}
	
	function addPersonLiteracy($person_id, $canRead, $canWrite, $speaksEnglish, $ownsMobilePhone, $internetSavy){
		$literacy_table = "censpro_literacy";
		$values = array(0 => $person_id, 1 => $canRead, 2 => $canWrite, 3 => $speaksEnglish, 4 => $ownsMobilePhone, 5 => $internetSavy );
		db_insert($literacy_table, $values);
	}
		
	function addSchoolsPersonAttended($school_name, $class, $year, $person_id){
		$school_table = "censpro_school_attended";
		$values = array(0 => $year, 1 => $class, 2 => $person_id, 3 => $school_name);
		db_insert($school_table, $values);
	}
		
	function addQualificationsPersonAchieved($qualification, $awarding_institute, $year, $person_id){
		$qualifications_table = "censpro_education";
		$values = array(0 => $person_id, 1 => $qualification, 2 => $year, 3 => $awarding_institute);
		db_insert($qualifications_table, $values);
	}	
	
	function addPersonDisability($disability, $person_id){
		$disability_table = "censpro_person_disabiity";
		$disability_id = getDisability_id($disability);
		$values = array(0 => $person_id, 1 => $disability_id);
		db_insert($disability_table, $values);
	} 
	
	function addPersonalEnterprise($business_name, $description, $person_id){
		$enterprise_table = "censpro_enterprise";
		$values = array(0 => $description, 1 => $person_id, 2 => "CURRENT_DATE", 3 => $business_name);
		db_insert($enterprise_table, $values);
	}
	
	function addHousehold($Household_head_name, $location, $district, $record_person_id){
		 $household_table = "censpro_household";
		 $head_person_id = getPersonId($Household_head_name);
		 $country_id = getCountry_id("Uganda");
		 $district_id = getDistrict_id($country_id, $district);
		 $values = array(0 => 0, 1 => $record_person_id, 2 => "CURRENT_DATE", 3 => $head_person_id, 4 => $location, 5 => $district_id);	
		 db_insert($household_table, $values);								
	}
		  
	function addHouseholdDisposalMethod($disposal_method, $household_id){
		$disposal_table = "censpro_waste_disposal";
		$disposal_id = getDisposalMethod_id($disposalMethod);
		$values = array(0 => 0, 1 => $household_id, 2 => $disposal_id, 3 => "CURRENT_DATE");
		db_insert($disposal_table, $values);
	}
	
	function addHouseholdKitchen($household_id, $kitchen_type){
		$kitchen_table = "censpro_kitchen";
		$kitchen_type_id = getKitchenType_id($kitchen_type);
		$values = array(0 => 0, 1 => $kitchen_type_id, 2 => $household_id, 3 => "CURRENT_DATE");
		db_insert($kitchen_table, $values);
	}
		 
	function defineHouseholdDistanceToCommunityServices($dst_public_health_facility, $dst_private_health_facility, $dst_public_primary_school, $dst_private_primary_school,
		 $dst_public_secondary_school, $dst_private_secondary_school, $dst_police, $household_id){
		 $community_services_table = "censpro_community_service";
		 $values = array(0 => $household_id, 1 => "CURRENT_DATE", 2 => $dst_public_health_facility, 3 => $dst_private_health_facility, 4 => $dst_public_primary_school, 5 => $dst_private_primary_school,
		  6 => $dst_public_secondary_school, 7 => $dst_private_secondary_school, 8 => $dst_police );
		db_insert($community_services_table, $values);
	}
	
	function addHouseholdRemittance($remittance_description, $country, $household_id){
		$remittance_table = "censpro_remittance";
		$country_id = getCountry_id($country);
		$values = array(0 => 0, 1 => $remittance_description, 2 => $household_id, 3 => $country_id, 4=> "CURRENT_DATE");
		db_insert($remittance_table, $values);
	}
	
	function addSourceOfLivelihood($livelihood_source, $household_id){
		$livelihood_table = "censpro_household_livelihood";
		$source_id = getLivelihoodSource_id($livelihood_source);
		$values = array (0 => "CURRENT_DATE", 1 => $source_id, 2=> $household_id);
		db_insert($livelihood_table, $values);
	}
	
	function defineHousingConditions($household_id, $occupancy, $energy_source, $water_source, $toilet_facility, $dwelling_type, $roof_material, $floor_material, $wall_material){
		$hConditions_table = "censpro_housing_condition";
		$occupancy_id = getOccupancy_id($occupancy);
		$energy_src_id = getEnergySource_id($energy_source);
		$dwelling_id = getDwellingType_id($dwelling_type);
		$wall_mat_id = getConstructionMaterial_id($wall_material);
		$water_src_id = getWaterSource_id($water_source);
		$toilet_id = getToiletFacility_id($toilet_facility);
		$roof_mat_id = getConstructionMaterial_id($roof_material);
		$floor_mat_id = getConstructionMaterial_id($floor_material);
		$values = array (0 => "CURRENT_DATE", 1 => 0, 2=> $household_id, 3 => $occupancy_id, 4 => $energy_src_id,
						5 => $dwelling_id, 6 => $wall_mat_id, 7 => $water_src_id, 8 => $toilet_id, 9 => $roof_mat_id,
						10 => $floor_mat_id);
		db_insert($hConditions_table, $values);		
	}
		 
	function addMemberToHousehold($member_name, $household_id){
		$person_table = "censpro_person";
		$person_id = getPersonId($member_name);
		db_query("UPDATE $person_table SET household_id = $household_id WHERE personId = $person_id");
	}
	
	function addAssetToHousehold($asset, $household_id, $quantity){
		$asset_table = "censpro_household_asset";
		$asset_id = getAsset_id($asset);
		$values = array (0 => $household_id, 1 => $asset_id, 2 => $quantity, 3 => "CURRENT_DATE");
		db_insert($asset_table, $values);
	}
	
	function addHouseholdAgriculture($farming_type, $no_products, $purpose, $location, $district, $household_id, $product_name){
		$farming_table= "";
		$product_id = 0;
		
		if($farming_type == "crop"){
			$farming_table= "censpro_plant_agriculture";
			$product_id = getCrop_id($product_name);
		}else{
			$farming_table= "censpro_animal_agriculture";
			$product_id = getAnimal_id($product_name);
		}
		
		$district_id = getDistrict_id2("Uganda", $district);
		$values = array(0 =>0, 1 => "CURRENT_DATE", 2 => $no_products, 3 => $purpose, 4 => $product_id, 5 => $household_id, 6 => $location, 7 => $district_id );
		db_insert($farming_table, $values);
	} 	  
	
?>