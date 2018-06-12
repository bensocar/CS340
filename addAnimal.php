<?php
  session_start();
  
    if (!isset($_SESSION['loggedin'])) {
        header("HTTP/1.0 403 Access Denied");
        echo '<h1>403 Access Denied. </h1><p>You must log in to access this page.  You will be redirected to the homepage in five seconds.</p>';
        echo "<script>setTimeout(function () {window.location.href= 'index.php';},5000);</script>";
        exit;
    }
  
  $currentpage = "Add Animal";
  include "pages.php";
?>
<!DOCTYPE html>
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
        $userName = mysqli_real_escape_string($conn, $_POST['userName']);
        $activityNotes = mysqli_real_escape_string($conn, $_POST['activityNotes']);
        $activityDate = mysqli_real_escape_string($conn, $_POST['activityDate']);


		  $queryIn = "Select * FROM Users1 WHERE userName='$userName'";
		  $resultIn = mysqli_query($conn, $queryIn);
		  if(!$resultIn){
			  die("Query to show fields from table failed");
		  }
		  $userRow = mysqli_fetch_row($resultIn);

		  if(date("Y-m-d") < $birthdate){
			  echo "Please enter a birthdate before the current time.";
		  }

		  else if($userRow == 0){
			  echo "Please enter a valid username.";
		  }
// See if pid is already in the table

		  else{
		// attempt insert query 
			$query = "INSERT INTO Animals (animalName, sex, type, breed, color, birthdate) VALUES ('$animalName', '$sex', '$type', '$breed', '$color', '$birthdate')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
		  
            $queryIn = "SELECT animalID FROM Animals WHERE animalName='$animalName' and sex='$sex' and birthdate='$birthdate'";
		$resultIn = mysqli_query($conn, $queryIn);
		if (!$resultIn) {
		die("Query to show fields from table failed");
	}
    $animalRow = mysqli_fetch_row($resultIn);
		$result = mysqli_query($conn, "CALL animalIntake('$animalRow[0]','$userName', '$activityNotes')") or die("Query fail: " . mysqli_error());
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
        <label>Sex:</label>
        <select name="sex" id="sex">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
      </p>

    <p>    
        <label>Animal Type:</label>
        <select name="type" id="type">
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
            <option value="Horse">Horse</option>
            <option value="Rabbit">Rabbit</option>
            <option value="Bird">Bird</option>
            <option value="Reptile">Reptile</option>
        </select>
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
    <p>
        <label for="userName">User Name:</label>
        <input type="text" class="required" name="userName" id="userName" required>
    </p>
    <p>
        <label for="activityNotes">Intake Notes:</label>
        <textarea class="required" name="activityNotes" id="activityNotes" maxlength="1000" rows="4" cols="50" required></textarea>
    </p>
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>
