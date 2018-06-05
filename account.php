<?php
  session_start();
  
  if (!isset($_SESSION['loggedin'])) {
        header("HTTP/1.0 403 Access Denied");
        echo '<h1>403 Access Denied. </h1><p>You must log in to access this page.  You will be redirected to the homepage in five seconds.</p>';
        echo "<script>setTimeout(function () {window.location.href= 'index.php';},5000);</script>";
        exit;
    }
    
  $currentpage = "Profile";
  include "pages.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Profile</title>
		<link rel="stylesheet" href="list.css">
	</head>
</html>
<body>
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
        echo '<p>Click here to edit your phone number. <a href="changeAccount.php">Edit Account</a></p>';
        echo '<p>Click here to change your password. <a href="changePw.php">Change Password</a></p>';

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
        echo '<p>Click here to edit account details. <a href="changeAccount.php">Edit Account</a></p>';
        echo '<p>Click here to change your password. <a href="changePw.php">Change Password</a></p>';

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
</body>
</html>