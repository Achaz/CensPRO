<?php
	include_once("Link.php");
	include_once("../function/core.php");
	
	function getLinks(){
		$links = array(
					0 => new Link("HOME", "./?l=0"), 
					1 => new Link("LITERACY", "./?l=1") ,
					2 => new Link("HOUSEHOLDS", "./?l=2")//, 3 => new Link("AGRICULTURE", "./?l=3")					
				  );
		return $links;
	}
	
	function getMenu($current_link){
		$links = getLinks();
		$menu = "<ul>";		
		for($i =0; $i<count($links); $i++)
			if($i == $current_link)
				$menu .= "<li><b><a href = '".$links[$i]->getURL()."'>".$links[$i]->getTitle()."</a></b></li>";
			else
				$menu .= "<li><a href = '".$links[$i]->getURL()."'>".$links[$i]->getTitle()."</a></li>";
		return $menu."</ul>";
	}
	
	function getTitle($current_link){
		$links = getLinks();
		return $links[$current_link]->getTitle();
		
	}
	
	function getBody($link){
		$res = db_select2("select count(personId) from censpro_person");		
		$total = $res[0][0];
		$res = db_select2("select count(household_id) from censpro_household");
		$total_households = $res[0][0];		
		$body = "";
		switch ($link) {
			case 0:				
				$res = db_select2("select count(personId) from censpro_person where gender ='male'");
				$male = $res[0][0];
				$year = date("Y");
				$year-=1;
				$res = db_select2("select count(personId) from censpro_person_death where date_recorded > $year");
				$past_deaths = $res[0][0];
				$res = db_select2("select max(censpro_person_death.cause_id), censpro_death_cause.description from censpro_person_death, censpro_death_cause where censpro_person_death.cause_id = censpro_death_cause.cause_id");
				$death_cause = $res[0][1];
				$res = db_select2("select max(censpro_household.discrict_id), censpro_district.district_name from censpro_household, censpro_district where censpro_household.discrict_id = censpro_district.discrict_id;");
				$populated_area = $res[0][1];
				$body = "
				<table>					
					<tr>
						<td align = 'right'>Population total:</td><td>".$total."</td>
					</tr>
					<tr>
						<td align = 'right'>% male: </td><td>".(int)(($male/$total)*100)." %</td>
					</tr>
					<tr>
						<td align = 'right'>% female:</td><td>".(int)((($total - $male)/$total)*100)." %</td>
					</tr>
					<tr>
						<td align = 'right'>Deaths in past year:</td><td>$past_deaths</td>
					</tr>
					<tr>
						<td align = 'right'>Most notable cause of death:</td><td>$death_cause</td>
					</tr>
					<tr>
						<td align = 'right'>Area With Highest Population:</td><td>$populated_area</td>
					</tr>					
				</table>
				"; 
				break;
				
			case 1:
				$res = db_select2("select count(personId) from censpro_literacy where canRead=1;");
				$canRead = $res[0][0];
				$res = db_select2("select count(personId) from censpro_literacy where canWrite=1;");
				$canWrite = $res[0][0];
				$res = db_select2("select count(personId) from censpro_literacy where speaksEnglish=1;");
				$soeaksEnglish = $res[0][0];
				$res = db_select2("select count(personId) from censpro_literacy where ownsMobilePhone=1;");
				$ownsMphone = $res[0][0];
				$res = db_select2("select count(personId) from censpro_literacy where internetSavy=1;");
				$netSavy = $res[0][0];
				
				$body = "
				<table style = 'padding-bottom: 20px'>
					<thead>
						<th>#</th><th>CAN READ</th><th>CAN WRITE</th><th>CAN SPEAK ENGLISH</th><th>OWN MOBILE PHONE</th><th>INTERNET SAVY</th>
					</thead>
					<tbody>
						<tr>
							<TD width=20 align='right'>% 0F POP'N</TD>
							<TD align = 'center'>".(int)(($canRead/$total)*100)."</TD>
							<TD align = 'center'>".(int)(($canWrite/$total)*100)."</TD>
							<TD align = 'center'>".(int)(($soeaksEnglish/$total)*100)."</TD>
							<TD align = 'center'>".(int)(($ownsMphone/$total)*100)."</TD>	
							<TD align = 'center'>".(int)(($netSavy/$total)*100)."</TD>														
						</tr>
					</tbody>								
				</table>
				The figures above are as per current records and may change as more data becomes available.
				"; 
				break;
			case 2:
				$res = db_select2("select count(censpro_housing_condition.occupancy_id) as count, max(censpro_housing_condition.occupancy_id) as max, censpro_occupancy.description as description from censpro_housing_condition, censpro_occupancy where censpro_occupancy.occupancy_id = censpro_housing_condition.occupancy_id");
				$occupancy_count = $res[0][0];
				$occupancy = $res[0][2];
				$res = db_select2("select count(censpro_housing_condition.toilet_facility_id) as count, max(censpro_housing_condition.toilet_facility_id) as max, censpro_toilet_facility.description as description from censpro_housing_condition, censpro_toilet_facility where censpro_housing_condition.toilet_facility_id = censpro_toilet_facility.toilet_facility_id");				
				$toilet_count = $res[0][0];
				$toilet_type = $res[0][2];
				$res = db_select2("select count(censpro_housing_condition.water_source_id) as count, max(censpro_housing_condition.water_source_id) as max, censpro_water_source.description as description from censpro_housing_condition, censpro_water_source where censpro_housing_condition.water_source_id = censpro_water_source.source_id");				
				$water_count = $res[0][0];
				$water_src = $res[0][2];
				$res = db_select2("select count(censpro_housing_condition.energy_source_id) as count, max(censpro_housing_condition.energy_source_id) as max, censpro_energy_source.description as description from censpro_housing_condition, censpro_energy_source where censpro_housing_condition.energy_source_id = censpro_energy_source.source_id");				
				$energy_count = $res[0][0];
				$energy_src = $res[0][2];
				$res = db_select2("select count(censpro_housing_condition.floor_material_id) as count, max(censpro_housing_condition.floor_material_id) as max, censpro_construction_material.description as description from censpro_housing_condition, censpro_construction_material where censpro_housing_condition.floor_material_id = censpro_construction_material.material_id");				
				$floor_material_count = $res[0][0];
				$floor_material = $res[0][2];				
				$res = db_select2("select count(censpro_housing_condition.roof_material_id) as count, max(censpro_housing_condition.roof_material_id) as max, censpro_construction_material.description as description from censpro_housing_condition, censpro_construction_material where censpro_housing_condition.roof_material_id = censpro_construction_material.material_id");				
				$roof_material_count = $res[0][0];
				$roof_material = $res[0][2];
				$res = db_select2("select count(censpro_housing_condition.wall_material_id) as count, max(censpro_housing_condition.wall_material_id) as max, censpro_construction_material.description as description from censpro_housing_condition, censpro_construction_material where censpro_housing_condition.wall_material_id = censpro_construction_material.material_id");				
				$wall_material_count = $res[0][0];
				$wall_material = $res[0][2];
				$res = db_select2("select count(censpro_housing_condition.dwelling_type_id) as count, max(censpro_housing_condition.dwelling_type_id) as max, censpro_dwelling_type.description as description from censpro_housing_condition, censpro_dwelling_type where censpro_housing_condition.dwelling_type_id = censpro_dwelling_type.dwelling_type_id");				
				$dwelling_count = $res[0][0];
				$dwelling_type = $res[0][2];
				$body = "
				<h3>Dominant House Construction Material Utilisation</h3>				
				<table style = 'padding-bottom: 20px'>
					<thead>
						<th>Floor material</th><th>Roof Material</th><th>Wall Material</th>
					</thead>
					<tbody>
						<tr>
							<TD align = 'center'>$floor_material -> ".(int)(($floor_material_count/$total_households)*100)."%</TD>
							<TD align = 'center'>$roof_material -> ".(int)(($roof_material_count/$total_households)*100)."%</TD>
							<TD align = 'center'>$wall_material -> ".(int)(($wall_material_count/$total_households)*100)."%</TD>												
						</tr>
					</tbody>								
				</table><br/>
				
				<h3>Dominant Choices for Household domestic Utilities</h3>				
				<table style = 'padding-bottom: 20px'>
					<thead>
						<th>Water Source</th><th>Energy Source</th>
					</thead>
					<tbody>
						<tr>
							<TD align = 'center'>$water_src -> ".(int)(($water_count/$total_households)*100)."%</TD>
							<TD align = 'center'>$energy_src -> ".(int)(($energy_count/$total_households)*100)."%</TD>												
						</tr>
					</tbody>								
				</table><br/>
				
				<h3>Dominant Choices for Housing Conditions</h3>				
				<table style = 'padding-bottom: 20px'>
					<thead>
						<th>Dwelling Type</th><th>Occupancy</th><th>Toilet</th>
					</thead>
					<tbody>
						<tr>
							<TD align = 'center'>$dwelling_type -> ".(int)(($dwelling_count/$total_households)*100)."%</TD>
							<TD align = 'center'>$occupancy -> ".(int)(($occupancy_count/$total_households)*100)."%</TD>
							<TD align = 'center'>$toilet_type -> ".(int)(($toilet_count/$total_households)*100)."%</TD>													
						</tr>
					</tbody>								
				</table>
				The figures above are as per current records and may change as more data becomes available.
				"; 
				break;
			default:
				$body = "The existance of this page is not intentional.";
				break;
		}
		return $body;		
	}

?>