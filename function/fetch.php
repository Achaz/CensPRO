<?php
	include_once("core.php");	
	
	function getEthnicity_id($etnicity){
		$id = getId("SELECT ethnicId FROM censpro_ethnicity where description = '$etnicity'");
		if($id == -1)
			$id = addEthnicity($etnicity);
		return $id;
	}
	
	function getReligion_id($religion){
		$id = getId("SELECT religionId FROM censpro_religion where description = '$religion'");
		if($id == -1)
			$id = addReligion($religion);
		return $id;
	}
	
	function getDisability_id($disability){
		$id = getId("SELECT disableId FROM censpro_disability where description = '$disability'");
		if($id == -1)
			$id = addDisability($disability);
		return $id;
	}
	
	function getDeathCause_id($causeOfDeath){
		$id = getId("SELECT cause_id FROM censpro_death_cause where description = '$causeOfDeath'");
		if($id == -1)
			$id = addDeathCause($causeOfDeath);
		return $id;
	}
	
	function getLivelihoodSource_id($source_of_livelihood){
		$id = getId("SELECT source_id FROM censpro_livelihood_source where description = '$source_of_livelihood'");
		if($id == -1)
			$id = addLivelihoodSource($source_of_livelihood);
		return $id;
	}
	
	function getAsset_id($asset){
		$id = getId("SELECT asset_id FROM censpro_asset where description = '$asset'");
		if($id == -1)
			$id = addAsset($asset);
		return $id;
	}
	
	function getKitchenType_id($kitchen_type){
		$id = getId("SELECT kitchen_type_id FROM censpro_kitchen_type where description = '$kitchen_type'");
		if($id == -1)
			$id = addKitchenType($kitchen_type);
		return $id;
	}
	
	function getToiletFacility_id($toilet_facility){
		
	$id = getId("SELECT toilet_facility_id FROM censpro_toilet_facility where description = '$toilet_facility'");
		if($id == -1)
			$id = addToiletFacility($toilet_facility);
		return $id;
	}
	
	function getEnergySource_id($energy_source){
		$id = getId("SELECT source_id FROM censpro_energy_source where description = '$energy_source'");
		if($id == -1)
			$id = addEnergySource($energy_source);
		return $id;
	}
	
	function getWaterSource_id($water_source){
		$id = getId("SELECT source_id FROM censpro_water_source where description = '$water_source'");
		if($id == -1)
			$id = addWaterSource($water_source);
		return $id;
	}
	
	function getDwellingType_id($dwelling_type){
		$id = getId("SELECT dwelling_type_id FROM censpro_dwelling_type where description = '$dwelling_type'");
		if($id == -1)
			$id = addDwellingType($dwelling_type);
		return $id;
	}
	
	function getCrop_id($crop){
		$id = getId("SELECT crop_id FROM censpro_crop where description = '$crop'");
		if($id == -1)
			$id = addCrop($crop);
		return $id;
	}
	
	function getAnimal_id($animal){
		$id = getId("SELECT livestock_id FROM censpro_livestock where description = '$animal'");
		if($id == -1)
			$id = addAnimal($animal);
		return $id;
	}
	
	function getOccupancy_id($occupancy){
		$id = getId("SELECT occupancy_id FROM censpro_occupancy where description = '$occupancy'");
		if($id == -1)
			$id = addOccupancy($occupancy);
		return $id;
	}
	
	function getConstructionMaterial_id($material){
		$id = getId("SELECT material_id FROM censpro_construction_material where description = '$material'");
		if($id == -1)
			$id = addConstructionMaterial($material);
		return $id;
	}
	
	function getCountry_id($country){
		$id = getId("SELECT country_id FROM censpro_country where country_name = '$country'");
		if($id == -1)
			$id = addCountry($country);
		return $id;
	}	
		
	function getDistrict_id($country_id, $district){
		$id = getId("SELECT discrict_id FROM censpro_district where district_name = '$district'");
		if($id == -1)
			$id = addDistrict($country_id, $district);
		return $id;
	}
	
	function getDistrict_id2($country, $district){
		$country_id = getCountry_id($country);
		$id = getDistrict_id($country_id, $district);
		return $id;
	}
	
	function getDisposalMethod_id($disposalMethod){
		$id = getId("SELECT disposal_method_id FROM censpro_disposal_method where description = '$disposalMethod'");
		if($id == -1)
			$id = addDisposalMethod($disposalMethod);
		return $id;
	}
	
	function getId($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result);
			return $row[0];	
		}
		return -1;
	}
	
	/*
	$qry = "select * from censpro_country";
		$and = getId($qry);
		echo "id: $and";*/
	
?>