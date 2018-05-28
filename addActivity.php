<!DOCTYPE html>
<?php
  session_start();
  $currentpage = "Log Activity";
  include "pages.php";
?>
<html>
	<head>
		<title>Add Animal Activity Record</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'connectvars.php';
	include 'header.php';
?>
