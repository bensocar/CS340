<?php
  session_start();
  $currentpage = "Home";
  include "pages.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home Page</title>
		<link rel="stylesheet" href="list.css">
		<script type = "text/javascript"  src = "list.js" > </script> 
	</head>
<body>
<?php
	include 'header.php';
?>
<main class="index">
<div>
<h1>Weclome to the Animal Shelter Database Homepage</h1>
</div>
<article>
<div><p><h3>About Us</h3></p>
</div>
<div><p><strong>Our mission:</strong> </p><p>To provide temporary shelter to stray, abandoned, and surrendered animals 
for the purpose of finding permanent suitable new homes. To provide assistance and 
financial aid to prevent overpopulation through spaying and neutering programs.</p>
<p><strong>Our History:</strong> </p><p>This shelter was started in 1997 by the founders: Carl Benson, Casey Ford, and Daniel Domme.
Our love for animals started when we were all working for the Multnomah County Animal Control.  We decided that we wanted to 
do better than the overtaxed Animal Control, and we wanted to provide more live outcomes to enhance our community.</p>
<p><strong>Our Employees:</strong>
<ul><li>Carl Beson: Shelter Carpenter and Founding Member</li><li>Case Ford: Shelter Manager and Founding Member</li><li>Daniel Domme: Shelter Janitorial Technician
and Founding Member</li></ul>
</p>
<p><h4>Thank You Volunteers!!</h4>
<img src="http://www.animatedimages.org/data/media/296/animated-festivity-and-celebration-image-0140.gif" border="0" alt="animated-festivity-and-celebration-image-0140" />
</p></div>
</article>
<article>
<div><p><h3>Contact Us</h3></p>
</div>
<div><ul><li>Phone Number: 541-223-2222</li>
<li>Email: <a href="#">asdb@hotmail.com</a></li><li>Mailing Address: 234 Animal Drive Corvallis, OR 97383</li></ul>
<div><p>Hours of Operation</p><ul><li>Monday: 11:00AM-5:00PM</li><li>Tuesday: 8:00AM-5:00PM</li><li>Wednesday: 8:00AM-5:00PM</li>
<li>Thursday: 11:00AM-5:00PM</li><li>Friday-Sunday: Closed</li></ul>
</div>
</article>
<article>
<div><p><h3>Get Involved</h3></p>
</div>
<div><p><a href="#">Volunteer by emailing us.</a> We are always looking for help and donations to take care of our furry friends.</p>
</article>

</main>
</body>
</html>