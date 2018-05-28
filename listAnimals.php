<!DOCTYPE html>
<?php
  session_start();
  $currentpage = "Search Animals";
  include "pages.php";
?>
<html>
	<head>
		<title>Search Animals</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'connectvars.php';
	include 'header.php';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$searchVal = mysqli_real_escape_string($conn, $_POST['searchVal']);
		$key = mysqli_real_escape_string($conn, $_POST['searchKey']);

// See if pid is already in the table
		$queryIn = "SELECT * FROM Animals WHERE $key LIKE '%$searchVal%'";
		$resultIn = mysqli_query($conn, $queryIn);
		if (!$resultIn) {
		die("Query to show fields from table failed");
	}
    $fields_num = mysqli_num_fields($resultIn);
    if(mysqli_num_rows($resultIn)==0){
        echo "<p style=\"color:crimson;\"> No results for search $searchVal</p>";
    }
    else{
	//echo "<h1>Animal:</h1>";
	echo "<table id='t01' border='1'><tr>";
	
// printing table headers
	for($i=0; $i<$fields_num; $i++) {	
		$field = mysqli_fetch_field($resultIn);	
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($resultIn)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
		echo "</tr>\n";
	}
	}	
		
			

}
mysqli_free_result($resultIn);
// close connection
mysqli_close($conn);
?>
	<section>
    <h2> <?php echo $msg; ?> </h2>

<form method="post" id="addForm">
<fieldset>
	<legend>Animal Search</legend>
    <div id="sameLine">
    <p>
   <select name="searchKey" id="searchKey">
  <option value="animalName">Name</option>
  <option value="animalID">Animal Id</option>
  <option value="type">Animal Type</option>
  <option value="breed">Breed</option>
  <option value="birthdate">Birth Date</option>
  <option value="sex">Sex</option>
  <option value="color">Color</option>
 </select>
 </p>
 <p>
        <label for="searchVal" id="searchWord">By:</label>
        <input type="text" class="required" name="searchVal" id="searchVal" placeholder="search..."></input>
    </p>
</fieldset>
</div>
      <p>
        <input type = "submit"  value = "Search" />
        <input type = "reset"  value = "Clear Search" />
      </p>
</form>
</body>
</html>