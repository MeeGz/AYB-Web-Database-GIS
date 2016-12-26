<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
$conn->close();
?>
<?php
$profpic = "DSC_0148.jpg";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {font-family: "Lato", sans-serif}
    .mySlides {display: none}
    </style>
    <style type="text/css">
        body {
        background-image: url('<?php echo $profpic;?>');
        }
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
      <a href="house.php">Houses</a>
      <a href="family.php">Families</a>
      <a href="ezbamember.php">Ezba People</a>
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
    
    
    <div class="container">
        
    </div>
</body>
</html>