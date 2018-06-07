<?php
session_start();
//$content holds a 2D array with keys being menu names and values being an array with a subtitle, and content
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    if($_SESSION['userType'] == 'E'){
        $content = array(
            "Home" => "index.php",
            "Add Animal" => "addAnimal.php",
            "Log Activity" => "addActivity.php",
            "Log Medical" => "addMedical.php",
            "Profile" => "account.php",
            "Search Animals" => "listAnimals.php",		
            "Search Activities" => "listActivities.php",		
            "Search Medical Records" => "listMedical.php",		
            "Logout" => "logout.php");
    }
    else if($_SESSION['userType'] == 'V'){
        $content = array(
            "Home" => "index.php",
            "Add Animal" => "addAnimal.php",
            "Log Activity" => "addActivity.php",            
            "Profile" => "account.php",
            "Search Animals" => "listAnimals.php",		
            "Search Activities" => "listActivities.php",		
            "Search Medical Records" => "listMedical.php",		
            "Logout" => "logout.php");
    }
}
else{
	$content = array(
		"Home" => "index.php",
		"Search Animals" => "listAnimals.php",
		"Search Activities" => "listActivities.php",
		"Search Medical Records" => "listMedical.php",
		"Login" => "login.php");
}
?>
