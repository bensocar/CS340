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


		echo "<h2>Hello volunteer " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</h2>";
    echo "<h3>You can change your password here.</h3>";
    echo "<p>To change your password, please enter your old password, enter your desired new password, and then retype it to confirm it.</p>";
    $givenUsername = $_SESSION['loggedin'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $oldPassWord = mysqli_real_escape_string($conn, $_POST['oldPassWord']);
        $newPassWord = mysqli_real_escape_string($conn, $_POST['newPassWord']);
        $checkNewPassWord = mysqli_real_escape_string($conn, $_POST['checkNewPassWord']);

        $queryInUser = "SELECT passWord FROM Users1 WHERE userName='$givenUsername'";
        $resultInUser = mysqli_query($conn, $queryInUser);
        if(!$resultInUser){
            die("Could not complete query" . mysqli_error());
        }
        $userRow = mysqli_fetch_row($resultInUser);
        if(md5($oldPassWord) != $userRow[0]){
            echo "<h4>Incorrect old password. Try again.</h4>";
        }
        else{
            if($newPassWord != $checkNewPassWord){
                echo "<h4>New password and retyped passwords do not match. Please reenter password information.</h4>";
            }
            else if($newPassWord == $oldPassWord){
                echo "<h4>New password must be different from old password. Please reenter password information.</h4>";
            }
            else{
                $queryInUser = "UPDATE Users1 SET passWord=MD5('$newPassWord') WHERE userName='$givenUsername'";
                $resultInUser = mysqli_query($conn, $queryInUser);
                if(!$resultInUser){
                    die("Could not complete query" . mysqli_error());
                }
                else{
                    echo '<h4><font color="green">Password successfully changed.</font></h4>';
                    echo "<script>location.href='account.php'</script>";
                }
            }
        }

    }

	mysqli_close($conn);

?>
<form method="post" id="addForm">
<fieldset>
	<legend>Change Password:</legend>
    <p>
        <label for="oldPassWord">Old Password:</label>
        <input type="password" maxlength="20" class="required" name="oldPassWord" id="oldPassWord" required ></input>
    </p>
    <p>
        <label for="newPassWord">New Password:</label>
        <input type="password" maxlength="20" class="required" name="newPassWord" id="newPassWord" required ></input>
    </p>
    <p>
        <label for="checkNewPassWord">Confirm New:</label>
        <input type="password" maxlength="20" class="required" name="checkNewPassWord" id="checkNewPassWord" required ></input>
    </p>
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>
