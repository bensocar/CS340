<!DOCTYPE html>
<?php
  session_start();
  $currentpage = "Profile";
  include "pages.php";
?>
<html>
	<head>
		<title>Profile</title>
		<link rel="stylesheet" href="list.css">
	</head>
</html>
<?php
	include 'connectvars.php';
  	include 'header.php';

	$conn =mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn){
		die('could not connect: ' . msql_error());
	}
	if($_SESSION['userType'] == 'V'){
		echo "<h2>Hello volunteer " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</h2>";
		echo "<p>Phone Number: " . $_SESSION['phoneNumber'] . "</p>";

		$givenUsername = $_SESSION['loggedin'];
		$queryIn = "SELECT * FROM Activities WHERE userName='$givenUsername' ORDER BY activityID";
		$resultIn = mysqli_query($conn, $queryIn);

		if(!$resultIn){
			die("Could not complete query" . mysqli_error());
		}

		echo "<p>Recent Activity: </p>"; 
		echo "<table id='t01' border='1'><tr>";
		for($i = 0; $i < mysqli_num_fields($resultIn); $i++){
			$field = mysqli_fetch_field($resultIn);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($resultIn)){
			echo "<tr>\n";
			foreach($row as $cell)
				echo "<td>$cell</td>";
			echo "</tr>\n";
		}
	}

	if($_SESSION['userType'] == 'E'){
		echo "<h2>Hello employee " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</h2>";
		echo "<p>Phone Number: " . $_SESSION['phoneNumber'] . "</p>";

	
		$givenUsername = $_SESSION['loggedin'];
		$queryEmpInfo = "SELECT salary, position FROM EmployeeUser WHERE empUserName='$givenUsername'";
		$resultEmpInfo = mysqli_query($conn, $queryEmpInfo);
		if(!$resultEmpInfo){
			die("Could not complete query" . mysqli_error());
		}

		$empUserRow = mysqli_fetch_row($resultEmpInfo);
		$empSalary = $empUserRow[0];
		$empPosition = $empUserRow[1];
		echo "<p>Salary: $$empSalary</p>";
		echo "<p>Position: $empPosition</p>";

		$queryIn = "SELECT * FROM MedicalRecord WHERE userName='$givenUsername' ORDER BY medicalDate";
		$resultIn = mysqli_query($conn, $queryIn);

		if(!$resultIn){
			die("Could not complete query" . mysqli_error());
		}

		echo "<p>Recent Records: </p>"; 
		echo "<table id='t01' border='1'><tr>";
		for($i = 0; $i < mysqli_num_fields($resultIn); $i++){
			$field = mysqli_fetch_field($resultIn);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($resultIn)){
			echo "<tr>\n";
			foreach($row as $cell)
				echo "<td>$cell</td>";
			echo "</tr>\n";
		}

	}
	mysqli_close($conn);

?>
