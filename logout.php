<?php
session_start();
$currentpage = "Logout";
include "pages.php";
?>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="list.css">
	</head>
</html>
<body>
<?php
	include "header.php";
	session_unset();
	echo "<script>location.href='index.php'</script>";
?>

</body>
