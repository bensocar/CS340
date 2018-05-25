<?php
session_start();
//$content holds a 2D array with keys being menu names and values being an array with a subtitle, and content
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	$content = array(
		"Home" => "index.php",
		"Add Animal" => "addAnimal.php",
		"Search Animals" => "listAnimals.php",
		"Log Activity" => "addActivity.php",
		"Search Activities" => "listActivities.php",
		"Log Medical" => "addMedical.php",
		"Search Medical Records" => "listMedical.php",
		"Profile" => "account.php");
}
else{
	$content = array(
		"Home" => "index.php",
		"Search Animals" => "listAnimals.php",
		"Search Activities" => "listActivities.php",
		"Search Medical Records" => "listMedical.php");
}
?>
