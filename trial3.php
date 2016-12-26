<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
$conn->close();
?>

<!DOCTYPE HTML>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
    <style>
    body {font-family: "Lato", sans-serif}
    .mySlides {display: none}
    .demo {cursor:pointer}
    .w3-left, .w3-right, .w3-badge {cursor:pointer}
    .w3-badge {height:13px;width:13px;padding:0}
    </style>
</head>
<body>


<!-- Navbar -->
<div class="w3-top">
<ul class="w3-navbar w3-black w3-card-2 w3-left-align">
  <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
    <a class="w3-padding-large" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
  </li>
  <li><a href="interface.php" class="w3-hover-none w3-hover-text-grey w3-padding-large">HOME</a></li>
  <li class="w3-hide-small"><a href="crew.php" class="w3-padding-large">CREW</a></li>
  <li class="w3-hide-small"><a href="project.php" class="w3-padding-large">PROJECTS</a></li>
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="javascript:void(0)" class="w3-hover-none w3-padding-large" title="More"> EZBA <i class="fa fa-caret-down"></i></a>     
    <div class="w3-dropdown-content w3-white w3-card-4">
      <a href="house.php">Homes</a>
      <a href="family.php">Families</a>
      <a href="ezbamember.php">People</a>
    </div>
  </li>
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="javascript:void(0)" class="w3-hover-none w3-padding-large" title="More">MORE <i class="fa fa-caret-down"></i></a>     
    <div class="w3-dropdown-content w3-white w3-card-4">
      <a href="#">Events</a>
      <a href="#">Extras</a>
      <a href="#">Media</a>
    </div>
  </li>
  <li class="w3-hide-small w3-right"><a href="logout.php" class="w3-padding-large">Log out</a></li>
</ul>
</div>
   
    
<!-- -->
<div class="w3-content" style="max-width:1200px">
  <img class="mySlides" src="DSC_0148.jpg" style="width:100%">
  <img class="mySlides" src="Untitled-1.jpg" style="width:100%">
  <img class="mySlides" src="14528282_10153723058301012_1641065070_n.jpg" style="width:100%">

  <div class="w3-row-padding w3-section">
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="img_nature_wide.jpg" style="width:100%" onclick="currentDiv(1)">
    </div>
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="img_fjords_wide.jpg" style="width:100%" onclick="currentDiv(2)">
    </div>
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="img_mountains_wide.jpg" style="width:100%" onclick="currentDiv(3)">
    </div>
  </div>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
</body>
</html>