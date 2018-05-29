<!DOCTYPE html>
<?php
  session_start();
  $currentpage = "Add Animal";
  include "pages.php";
?>
<html>
	<head>
		<title>Add New Animal</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'connectvars.php';
	include 'header.php';
    echo "<h1>Add a New Animal</h1> ";
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$animalName = mysqli_real_escape_string($conn, $_POST['animalName']);
		$sex = mysqli_real_escape_string($conn, $_POST['sex']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
        $breed = mysqli_real_escape_string($conn, $_POST['breed']);
		$color = mysqli_real_escape_string($conn, $_POST['color']);
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
	
// See if pid is already in the table
		
		// attempt insert query 
			$query = "INSERT INTO Animals (animalName, sex, type, breed, color, birthdate) VALUES ('$animalName', '$sex', '$type', '$breed', '$color', '$birthdate')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
		

}
// close connection
mysqli_close($conn);

?>
	<section>
    <h2> <?php echo $msg; ?> </h2>

<form method="post" id="addForm">
<fieldset>
	<legend>Enter New Animal Info:</legend>
    <p>
        <label for="animalName">Animal Name:</label>
        <input type="text" maxlength="30" class="required" name="animalName" id="animalName" required>
    </p>
    <p>
        <label for="sex">Sex:</label>
        <input type="text" maxlength="7" class="required" name="sex" id="sex" required>
    </p>

    <p>
        <label for="type">Animal Type:</label>
        <input type="text" class="required" name="type" id="type" maxlength="20" required>
        </p>
        <p>
        <label for="breed">Breed:</label>
        <input type="text" maxlength="30" class="required" name="breed" id="breed" required>
    </p>

    <p>
        <label for="color">Animal Color:</label>
        <input type="text" class="required" name="color" id="color" maxlength="30" required>
        </p>
        <p>
        <label for="birthdate">Birth Date:</label>
        <input type="text" name="birthdate" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>
    </p>
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>