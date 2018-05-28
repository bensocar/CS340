<!DOCTYPE html>
<?php
  session_start();
  $currentpage = "Add Animal";
  include "pages.php";
?>
<html>
	<head>
		<title>Add New Animal</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'connectvars.php';
	include 'header.php';
?>
