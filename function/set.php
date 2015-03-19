<?php
	include_once("core.php");
	
	function addEthnicity($etnicity){
		$values = array(0 => 0, 1 => $etnicity);
		$success = db_insert("censpro_ethnicity", $values);
		if($success){
			$id = getEthnicity_id($etnicity);
			return $id;
		}			
		return -1;		
	}
	
	function addReligion($religion){
		$values = array(0 => 0, 1 => $religion);
		$success = db_insert("censpro_religion", $values);
		if($success){
			$id = getReligion_id($religion);
			return $id;
		}			
		return -1;		
	}
	
	function addDisability($disability){
		$values = array(0 => 0, 1 => $disability);
		$success = db_insert("censpro_disability", $values);
		if($success){
			$id = getDisability_id($disability);
			return $id;
		}			
		return -1;		
	}
	
	function addDeathCause($causeOfDeath){
		$values = array(0 => 0, 1 => $causeOfDeath);
		$success = db_insert("censpro_death_cause", $values);
		if($success){
			$id = getDeathCause_id($causeOfDeath);
			return $id;
		}			
		return -1;		
	}
	
	function addLivelihoodSource($source_of_livelihood){
		$values = array(0 => 0, 1 => $source_of_livelihood);
		$success = db_insert("censpro_livelihood_source", $values);
		if($success){
			$id = getDeathCause_id($source_of_livelihood);
			return $id;
		}			
		return -1;
	}
	
	function addHouseholdAsset($asset, $quantity, $household_id){
		$asset_id = getAsset_id($asset);
		$values = array(0 => $household_id, 1 => $asset_id, 2 => 0, 3 => $quantity, 4 => "CURRENT_DATE");
		$success = db_insert("censpro_death_cause", $values);		
	}
	
	function addDisposalMethod($disposalMethod){
		$values = array(0 => 0, 1 => $disposalMethod);
		$success = db_insert("censpro_disposal_method", $values);
		if($success){
			$id = getDisposalMethod_id($disposalMethod);
			return $id;
		}			
		return -1;		
	}
	
	function addAsset($asset){
		$values = array(0 => 0, 1 => $asset);
		$success = db_insert("censpro_asset", $values);
		if($success){
			$id = getAsset_id($asset);
			return $id;
		}			
		return -1;
	}
	
	function addKitchenType($kitchen_type){
		$values = array(0 => 0, 1 => $kitchen_type);
		$success = db_insert("censpro_kitchen_type", $values);
		if($success){
			$id = getKitchenType_id($kitchen_type);
			return $id;
		}			
		return -1;
	}
	
	function addToiletFacility($toilet_facility){
		$values = array(0 => 0, 1 => $toilet_facility);
		$success = db_insert("censpro_toilet_facility", $values);
		if($success){
			$id = getToiletFacility_id($toilet_facility);
			return $id;
		}			
		return -1;
	}
	
	function addEnergySource($energy_source){
		$values = array(0 => 0, 1 => $energy_source);
		$success = db_insert("censpro_energy_source", $values);
		if($success){
			$id = getEnergySource_id($energy_source);
			return $id;
		}			
		return -1;
	}
	
	function addWaterSource($water_source){
		$values = array(0 => 0, 1 => $water_source);
		$success = db_insert("censpro_water_source", $values);
		if($success){
			$id = getWaterSource_id($water_source);
			return $id;
		}			
		return -1;
	}
	
	function addDwellingType($dwelling_type){
		$values = array(0 => 0, 1 => $dwelling_type);
		$success = db_insert("censpro_dwelling_type", $values);
		if($success){
			$id = getDwellingType_id($dwelling_type);
			return $id;
		}			
		return -1;
	}
	
	function addCrop($crop){
		$values = array(0 => 0, 1 => $crop);
		$success = db_insert("censpro_crop", $values);
		if($success){
			$id = getCrop_id($crop);
			return $id;
		}			
		return -1;
	}
	
	function addAnimal($animal){
		$values = array(0 => 0, 1 => $animal);
		$success = db_insert("censpro_livestock", $values);
		if($success){
			$id = getAnimal_id($animal);
			return $id;
		}			
		return -1;
	}
	
	function addOccupancy($occupancy){
		$values = array(0 => 0, 1 => $occupancy);
		$success = db_insert("censpro_occupancy", $values);
		if($success){
			$id = getOccupancy_id($occupancy);
			return $id;
		}			
		return -1;
	}
	
	function addConstructionMaterial($material){
		$values = array(0 => 0, 1 => $material);
		$success = db_insert("censpro_construction_material", $values);
		if($success){
			$id = getConstructionMaterial_id($material);
			return $id;
		}			
		return -1;
	}
	
	function addCountry($country){
		$values = array(0 => 0, 1 => $country);
		$success = db_insert("censpro_country", $values);
		if($success){
			$id = getCountry_id($country);
			return $id;
		}			
		return -1;
	}
		
	function addDistrict($country_id, $district){
		$values = array(0 => 0, 1 => $district, 2 => $country_id);
		$success = db_insert("censpro_district", $values);
		if($success){
			$id = getDistrict_id($country_id, $district);
			return $id;
		}			
		return -1;
	}
	
	function addDistrict1($country, $district){
		$country_id = getCountry_id($country);
		$id = addDistrict($country_id, $district);	
		if($id > 0){
			return $id;
		}			
		return -1;
	}
	
?>