<?php
    include_once("../function/android.php");
	//Get the json string from the parameter in the request body     
     $jsonStringRaw = $_POST["person"]; // *******************************	I DON'T KNOW WHAT YOU SENT
     
     //Remove any redundant slashes in the string( this part might bring issues, let BISHAKA know if any )
     $cleanedString = stripcslashes($jsonStringRaw);

     //decode the json string, this returns an array object that is simillar to the object passed in the json string(I HOPE)
     $master_array = json_decode($cleanedString, TRUE);	
     
	$person_name = $master_array['fullname'];
	$father = $master_array['fname'];		
	$mother = $master_array['mname'];		
	$gender = $master_array['gender'];
	$religion = $master_array['religion'];
	$ethnicity = $master_array['ethinic'];
	$disability = $master_array['disability'];	
	$canRead = $master_array['canread'];
	$canWrite  = $master_array['canwrite'];
	$speaksEnglish = $master_array['canspeak_english'];
	$internetSavy = $master_array['canuse_internet'];
	$hasMobilePhone = $master_array['hasphone'];
	$dateOfBirth = $master_array['dob'];
	$record_person_id = 1;// --> missed record person (cannot be null)
	
	//**** LIST VARIABLES
	$school_list = $master_array['school_list'];
        $qual_list = $master_array['qual_list'];
        // --> missed list of qualifications
	
	//create person	
	$person_id = addPerson($dateOfBirth, $father, $mother, $ethnicity, $religion, $record_person_id, $person_name, $gender, $household_id);
	
	//define literacy
	addPersonLiteracy($person_id, $canRead, $canWrite, $speaksEnglish, $hasMobilePhone, $internetSavy);
	
	//record schools attended
	
	for($i = 0; $i < count($school_list); $i++){
           $school_info = $school_list[$i];
           $school_name = $school_info['schoolname'];
           $class = $school_info['classname'];
           $year = $school_info['year'];
	   addSchoolsPersonAttended($school_name, $class, $year, $person_id);
        }
	
	
	//record qualifications
        for($i = 0; $i < count($school_list); $i++){
         
          $qualification = $qual_list[$i];
          $awarding_institute = $qualification['instname'];
          $qualname = $qualification['qualification'];
          $year = $qualification['year'];
	  addQualificationsPersonAchieved($qualname, $awarding_institute, $year, $person_id);
        }
	
	//add disability
	addPersonDisability($disability, $person_id);
	
        $response["message"] = $person_name;
	echo json_encode($response);
	
?>
