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
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/add.css">
</head>
<body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="">
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Log out</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-header">
            <li><a><?php echo $_COOKIE["admin"]; ?></a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
        <div class="row">
            <a href="ezbamember.php" class="btn btn-lg btn-primary">Ezba Member</a>
        </div> <br>
        <div class="row">
            <a href="family.php" class="btn btn-lg btn-primary">Ezba Family</a>
        </div> <br>
        <div class="row">
            <a href="house.php" class="btn btn-lg btn-primary">Ezba Homes</a>
        </div> <br>
        <div class="row">
            <a href="interface.php" class="btn btn-lg btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
        </div>
    </div>
</body>
</html>