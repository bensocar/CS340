<?php
  session_start();
  $currentpage = "Animal Details";
  include "pages.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Animal Details</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script>
	</head>
<body>

<?php
    include 'connectvars.php';
    include 'header.php';
    echo "<h1>View Animal Details</h1> ";
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    $animalID = $_GET['id'];
    $queryIn = "SELECT animalID as 'ID', animalName as 'Name', sex as 'Sex', birthdate as 'DOB', type as 'Animal Type', breed as 'Breed', color as 'Color' FROM Animals WHERE animalID = $animalID";
    $resultIn = mysqli_query($conn, $queryIn);
    if (!$resultIn) {
        die("Query to show fields from table failed");
    }
$fields_num = mysqli_num_fields($resultIn);
if (mysqli_num_rows($resultIn)==0) {
    echo "<p style=\"color:crimson;\"> No results for search </p>";
} else {
    //echo "<h1>Animal:</h1>";
    echo "<table id='t01' border='1'><tr>";

    // printing table headers
    for ($i=0; $i<$fields_num; $i++) {
        $field = mysqli_fetch_field($resultIn);
        echo "<td><b>$field->name</b></td>";
    }
    echo "</tr>\n";
    while ($row = mysqli_fetch_row($resultIn)) {
        echo "<tr>";
        // $row is array... foreach( .. ) puts every element
        // of $row to $cell variable
        foreach ($row as $cell) {
            echo "<td>$cell</td>";
        }
        echo "</tr>\n";
    }
}

    $queryIn = "SELECT a.activityID as 'Activity ID', a.activityNotes as 'Notes', a.animalID as 'Animal ID', a.userName as 'Username', a.activityCode as 'Code', c.activityDesc as 'Description', a.activityDate as 'Date' FROM Activities a, ActivityCode c WHERE a.animalID = $animalID AND a.activityCode = c.activityCode";
    $resultIn = mysqli_query($conn, $queryIn);
    if (!$resultIn) {
        die("Query to show fields from table failed");
    }
    $fields_num = mysqli_num_fields($resultIn);
    if (mysqli_num_rows($resultIn)==0) {
        echo "<p style=\"color:crimson;\"> No activity records found.</p>";
    } else {
        //echo "<h1>Animal:</h1>";
        echo "<table id='t01' border='1'><tr>";

        // printing table headers
        for ($i=0; $i<$fields_num; $i++) {
            $field = mysqli_fetch_field($resultIn);
            echo "<td><b>$field->name</b></td>";
        }
        echo "</tr>\n";
        while ($row = mysqli_fetch_row($resultIn)) {
            $animalID = $row[2];
            echo "<tr>";
            // $row is array... foreach( .. ) puts every element
            // of $row to $cell variable
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }
            echo "</tr>\n";
        }
    }

    echo "<h1>View Animal Activity History</h1> ";

  $queryIn = "SELECT m.recordID as 'Record ID', m.medicalNotes as 'Notes', m.medicalCode as 'Code', c.medicalDesc as 'Description', m.animalID as 'Animal ID', m.userName as 'Username', m.medicalDate as 'Date' FROM MedicalRecord as m, MedicalCode as c WHERE m.animalID = $animalID AND m.medicalCode = c.medicalCode";
  $resultIn = mysqli_query($conn, $queryIn);
  if (!$resultIn) {
      die("Query to show fields from table failed");
  }
  $fields_num = mysqli_num_fields($resultIn);
  if (mysqli_num_rows($resultIn)==0) {
      echo "<p style=\"color:crimson;\">No medical records found.</p>";
  } else {
      //echo "<h1>Animal:</h1>";
      echo "<table id='t01' border='1'><tr>";

      // printing table headers
      for ($i=0; $i<$fields_num; $i++) {
          $field = mysqli_fetch_field($resultIn);
          echo "<td><b>$field->name</b></td>";
      }
      echo "</tr>\n";
      while ($row = mysqli_fetch_row($resultIn)) {
          echo "<tr>";
          // $row is array... foreach( .. ) puts every element
          // of $row to $cell variable
          foreach ($row as $cell) {
              echo "<td>$cell</td>";
          }
          echo "</tr>\n";
      }
  }
    echo "<h1>View Animal Medical History</h1> ";
mysqli_free_result($resultIn);
// close connection
mysqli_close($conn);
?>

    <?php echo $msg; ?>

</body>
</html>
