<?php
  session_start();
  $currentpage = "Search Medical Records";
  include "pages.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Search Medical Records</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>

<?php
	include 'connectvars.php';
	include 'header.php';
    echo "<h1>Search for Medical Records</h1> ";
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$searchVal = mysqli_real_escape_string($conn, $_POST['searchVal']);
		$key = mysqli_real_escape_string($conn, $_POST['searchKey']);

		$queryIn = "SELECT m.recordID as 'Record ID', m.medicalNotes as 'Notes', m.medicalCode as 'Code', c.medicalDesc as 'Description', m.animalID as 'Animal ID', m.userName as 'Username', m.medicalDate as 'Date' FROM MedicalRecord as m, MedicalCode as c WHERE $key LIKE '%$searchVal%' AND m.medicalCode = c.medicalCode";
		$resultIn = mysqli_query($conn, $queryIn);
		if (!$resultIn) {
		die("Query to show fields from table failed");
	}
    $fields_num = mysqli_num_fields($resultIn);
    if(mysqli_num_rows($resultIn)==0){
        echo "<p style=\"color:crimson;\"> No results for search \"$searchVal\"</p>";
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
       
    <?php echo $msg; ?> 

<form method="post" id="addForm">
<fieldset>
	<legend>Medical Record Search</legend>
    <div id="sameLine">
    <p>
   <select name="searchKey" id="searchKey">
  <option value="recordID">Medical Record Id</option>
  <option value="animalID">Animal Id</option>
  <option value="userName">Username</option>
  <option value="medicalCode">Medical Code</option>
  <option value="medicalDate">Medical Entry Date</option>
  <option value="medicalNotes">Medical Notes</option>
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