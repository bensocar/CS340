<?php
session_unset();
session_start();
$currentpage = 'Login';
include 'pages.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="list.css">
	</head>
	<body>
<?php
include 'connectvars.php';
include 'header.php';

$msg = 'Please enter your username and password.';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$conn){
	die("Could not connect: " . mysql_error());
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$givenUsername = mysqli_real_escape_string($conn, $_POST['givenUsername']);
	$givenPassword = mysqli_real_escape_string($conn, $_POST['givenPassword']);

	$queryInUser = "SELECT * FROM Users1 WHERE userName='$givenUsername' AND passWord=md5('$givenPassword')";

	$resultInUser = mysqli_query($conn, $queryInUser);

	if(!$resultInUser){
		die("Could not complete query" . mysqli_error());
	}

	$userRow = mysqli_fetch_row($resultInUser);
	if($userRow == 0){
		$msg = "Your username or password is incorrect.";
	}
	else{
		$msg = "Thank you for logging in, $userRow[2]!";
		$_SESSION['loggedin'] = $userRow[0];
		$_SESSION['firstName'] = $userRow[2];
		$_SESSION['lastName'] = $userRow[3];
		$_SESSION['userType'] = $userRow[4];
		$_SESSION['phoneNumber'] = $userRow[5];

		echo "<script>location.href='account.php'</script>";
	}
}

mysqli_close($conn);

?>

<section>
	<h1> <?php echo $msg; ?> </h1>
	<p>Need an accout? <a href="addAccount.php"> Click Here</a>
	<form method="post" id="loginForm">
		<fieldset>
			<p>
				<label for="givenUsername">Username:</label>
				<input type="text" name="givenUsername" id="givenUsername">
			</p>
			<p>
				<label for="givenPassword">Password:</label>
				<input type="password" name="givenPassword" id="givenPassword">
			</p>
		</fieldset>

		<p>
			<input type="submit" value="Submit"/>
			<input type="reset" value"Clear Form"/>
		</p>

	</form>
</section>

	</body>
</html>
