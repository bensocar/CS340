<?php
  session_start();
  $currentpage = "Log Medical";
  include "pages.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add Medical Record Entry</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'connectvars.php';
	include 'header.php';
    echo "<h1>Add a New Animal Medical Record</h1> ";
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$animalID = mysqli_real_escape_string($conn, $_POST['animalID']);
		$userName = mysqli_real_escape_string($conn, $_POST['userName']);
		$medicalCode = mysqli_real_escape_string($conn, $_POST['medicalCode']);
        $medicalDate = mysqli_real_escape_string($conn, $_POST['medicalDate']);
		$medicalNotes = mysqli_real_escape_string($conn, $_POST['medicalNotes']);
	
// See if pid is already in the table
		
		// attempt insert query 
			$query = "INSERT INTO MedicalRecord (animalID, userName, medicalCode, medicalDate, medicalNotes) VALUES ('$animalID', '$userName', '$medicalCode', '$medicalDate', '$medicalNotes')";
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
	<legend>Activity Info:</legend>
    <p>
        <label for="animalID">Animal ID:</label>
        <input type="number" min=1 max = 99999 class="required" name="animalID" id="animalID" required>
    </p>
    <p>
        <label for="userName">User Name:</label>
        <input type="text" class="required" name="userName" id="userName" required>
    </p>

    <p>    
        <label>Medical Code:</label>
        <select name="medicalCode" id="medicalCode">
            <option value="1">1: Exam</option>
            <option value="2">2: Immunization</option>
            <option value="3">3: Treatment</option>
            <option value="4">4: Surgery</option>
            <option value="5">5: Euthanize</option>
        </select>
      </p>
        <p>
        <label for="medicalDate">Date:</label>
        <input type="text" name="medicalDate" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>
    </p>
    <p>
        <label for="medicalNotes">Medical Notes:</label>
        <textarea class="required" name="medicalNotes" id="medicalNotes" maxlength="1000" rows="4" cols="50" required></textarea>
    </p>
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>