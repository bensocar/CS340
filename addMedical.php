<!DOCTYPE html>
<?php
  session_start();
  $currentpage = "Log Medical";
  include "pages.php";
?>
<html>
	<head>
		<title>Add Medical Record Entry</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'connectvars.php';
	include 'header.php';
?>
