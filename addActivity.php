<!DOCTYPE html>
<?php
  session_start();
  
    if (!isset($_SESSION['loggedin'])) {
        header("HTTP/1.0 403 Access Denied");
        echo '<h1>403 Access Denied. </h1><p>You must log in to access this page.  You will be redirected to the homepage in five seconds.</p>';
        echo "<script>setTimeout(function () {window.location.href= 'index.php';},5000);</script>";
        exit;
    }

  $currentpage = "Log Activity";
  include "pages.php";
?>
<html>
	<head>
		<title>Add Animal Activity Record</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'connectvars.php';
	include 'header.php';
    echo "<h1>Add a New Animal Activity</h1> ";
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$animalID = mysqli_real_escape_string($conn, $_POST['animalID']);
		$userName = mysqli_real_escape_string($conn, $_POST['userName']);
		$activityCode = mysqli_real_escape_string($conn, $_POST['activityCode']);
        $activityDate = mysqli_real_escape_string($conn, $_POST['activityDate']);
		$activityNotes = mysqli_real_escape_string($conn, $_POST['activityNotes']);
	
// See if pid is already in the table
		
		// attempt insert query 
			$query = "INSERT INTO Activities (animalID, userName, activityCode, activityDate, activityNotes) VALUES ('$animalID', '$userName', '$activityCode', '$activityDate', '$activityNotes')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Not able to add because " . mysqli_error($conn);
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
        <label>Activity Code:</label>
        <select name="activityCode" id="activityCode">
            <option value="1">1: Shelter Intake</option>
            <option value="2">2: Send to Foster</option>
            <option value="3">3: Adopt Out</option>
            <option value="4">4: Shelter Return</option>
            <option value="5">5: Shelter Transfer</option>
            <option value="6">6: Walk</option>
            <option value="7">7: Play Time</option>
        </select>
        </p>
        <p>
        <label for="activityDate">Date:</label>
        <input type="text" name="activityDate" placeholder="YYYY-MM-DD" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>
    </p>
    <p>
        <label for="activityNotes">Activity Notes:</label>
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
