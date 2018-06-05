<?php
  session_start();
  
  if (!isset($_SESSION['loggedin'])) {
        header("HTTP/1.0 403 Access Denied");
        echo '<h1>403 Access Denied. </h1><p>You must be logged in and an employee to access this page.  You will be redirected to the in five seconds.</p>';
        echo "<script>setTimeout(function () {window.location.href= 'index.php';},5000);</script>";
        exit;
    }
    
  $currentpage = "Profile";
  include "pages.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Profile</title>
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
        echo "<p>Change phone number.</p>";
        $givenUsername = $_SESSION['loggedin'];
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $volPhone = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
            $queryInUser = "UPDATE Users1 SET phoneNumber='$volPhone' WHERE userName='$givenUsername'";
            $resultInUser = mysqli_query($conn, $queryInUser);
            if(!$resultInUser){
                die("Could not complete query" . mysqli_error());
            }
            else{
                $_SESSION['phoneNumber'] = $volPhone;
                echo "<script>location.href='account.php'</script>";
            }
        }
    }

	if($_SESSION['userType'] == 'E'){
		echo "<h2>Hello employee " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</h2>";
        echo "<p>Change any of the user information that you want.</p>";
	
		$givenUsername = $_SESSION['loggedin'];
		$queryEmpInfo = "SELECT salary, position FROM EmployeeUser WHERE empUserName='$givenUsername'";
		$resultEmpInfo = mysqli_query($conn, $queryEmpInfo);
		if(!$resultEmpInfo){
			die("Could not complete query" . mysqli_error());
		}

		$empUserRow = mysqli_fetch_row($resultEmpInfo);
		$empSalary = $empUserRow[0];
		$empPosition = $empUserRow[1];
	
    if($_SERVER["REQUEST_METHOD"] == "POST"){
	$empSalary = mysqli_real_escape_string($conn, $_POST['salary']);
	$empPosition = mysqli_real_escape_string($conn, $_POST['position']);
    $empPhone = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

	
    $queryInUser = "UPDATE Users1 SET phoneNumber='$empPhone' WHERE userName='$givenUsername'";
	$resultInUser = mysqli_query($conn, $queryInUser);
	if(!$resultInUser){
		die("Could not complete query" . mysqli_error());
	}
    
    $queryInUser = "UPDATE EmployeeUser SET salary='$empSalary', position='$empPosition' WHERE empUserName='$givenUsername'";
	$resultInUser = mysqli_query($conn, $queryInUser);
    if(!$resultInUser){
		die("Could not complete query" . mysqli_error());
	}
    
    else{
        $_SESSION['phoneNumber'] = $empPhone;
        echo "<script>location.href='account.php'</script>";
	}
    }
}
	mysqli_close($conn);

?>
<form method="post" id="addForm">
<fieldset>
	<legend>Change Password:</legend>
    <p>
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" maxlength="20" class="required" name="phoneNumber" id="phoneNumber" required value="<?php echo (isset($_SESSION['phoneNumber'])) ? $_SESSION['phoneNumber']: ''?>"></input>
    </p>    
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>