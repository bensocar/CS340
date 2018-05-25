<header>
  <?php
  session_start();
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo "Welcome back, " . $_SESSION['firstName'] . "!";
  }
  else{
    echo "Welcome to the Group 11 Project Webpage!";
  }
  ?>
</header>
<nav>
  <ul>
  <?php
  foreach ($content as $page => $location){
    echo "<li><a href='$location' ".($page==$currentpage?" class='active'":"").">".$page."</a></li>";
  }
  ?>
  </ul>

</nav>
