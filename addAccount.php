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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
<?php
include 'connectvars.php';
include 'header.php';

$msg = 'Please fill out the forms below.';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Could not connect: " . mysql_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

    $userType = mysqli_real_escape_string($conn, $_POST['userType']);
    $userAge = mysqli_real_escape_string($conn, $_POST['age']);
    $userSalary = mysqli_real_escape_string($conn, $_POST['userSal']);
    $userPosition = mysqli_real_escape_string($conn, $_POST['userPos']);

    $givenUsername = mysqli_real_escape_string($conn, $_POST['givenUsername']);
    $givenPassword = mysqli_real_escape_string($conn, $_POST['givenPassword']);

    $newUser = "INSERT INTO Users1(firstName, lastName, userType, phoneNumber, userName, passWord)
                  VALUES('$fName', '$lName', '$userType', '$phoneNumber', '$givenUsername', md5('$givenPassword'))";
    $resultNewUser = mysqli_query($conn, $newUser);

    if (!$resultNewUser) {
        die("Could not complete query" . mysqli_error());
    }

    if($userType == "V"){
      $date = date('Y-m-d');
      $newUser = "INSERT INTO VolunteerUser(volUserName, age, startDate)
                    VALUES('$givenUsername', '$userAge', '$date')";
    }
    else{
      $newUser = "INSERT INTO EmployeeUser(empUserName, salary, position)
                   VALUES('$givenUsername', '$userSalary', '$userPosition')";
    }

    $resultNewUser = mysqli_query($conn, $newUser);

    if (!$resultNewUser) {
        die("Could not complete query" . $newUser);
    }
    echo "<script>location.href='login.php'</script>";
}

mysqli_close($conn);

?>

<section>
	<h1> <?php echo $msg; ?> </h1>

	<form method="post" id="loginForm">
		<fieldset>
      <p>
        <label for="fName">First Name:</label>
        <input type="text" name="fName" id="fName">
      </p>
      <p>
        <label for="lName">Last Name:</label>
        <input type="text" name="lName" id="lName">
      </p>
      <p>
        <input type="radio" id="userV" name="userType" value="V">
        <label for="userV">Volunteer: </label><br />

        <input type="radio" id="userE" name="userType" value="E">
        <label for="userV">Employee: </label>
      </p>
      <p>
        <div class="v">
          <label for="age">Age:</label>
          <input type="number" min="1" max="150" name="age" id="age">
        </div>
        <div class="e">
          <p>
          <label for="userSal">Salary:</label>
          <input type="text" name="userSal" id="userSal">
          </p>
          <p>
          <label for="userPos">Position:</label>
          <input type="text" name="userPos" id="userPos">
        </p>
        </div>
      </p>
      <p>
        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" name="phoneNumber" id="phoneNumber">
      </p>
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
  <script>
  $(document).ready(function(){
    $(".v").hide();
    $(".e").hide();
  })
  $(function () {
    $('input[type="radio"]').on("click",function () {
      $(".v").hide();
      $(".e").hide();

      if (this.value == "V")
        $(".v").show();
      else
        $(".e").show();
    });
  });
  </script>
</section>

	</body>
</html>
