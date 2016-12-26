<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}

$sql = "SELECT * FROM ezbamember WHERE memberID ='".$_GET['id']."'";
$memberdetails = $conn->query($sql);
$memberdetails = $memberdetails->fetch_assoc();
$sql = "SELECT conditionn FROM inferior WHERE memberID='".$_GET['id']."'";
$condition = $conn->query($sql);
$condition = $condition->fetch_assoc();
class ezbaMember{
    public $name;
    public $famName;
    public $sex;
    public $birthDate;
    public $educationCond;
    public $educationLevel;
    public $educationExpenses;
}
class inferior{
    public $condition;
}
$m = new ezbaMember;
$i = new inferior;
$record = "";
if (isset($_POST['name'])) {
    $m->name = $_POST['name'];
    $m->famName = $_POST['famName'];
    $m->sex = $_POST['sex'];
    $m->birthDate = $_POST['birthDate'];
    $m->educationCond = $_POST['educationCond'];
    $m->educationLevel = $_POST['educationLevel'];
    $m->educationExpenses = $_POST['educationExpenses'];
    if (isset(elly goa el conditon)){
      $i->conditon = $_POST['conditon'];
    }
    $sql = "UPDATE ezbamember SET name = '".$m->name."', famName='".$m->famName."', sex='".$m->sex."', birthDate='".$m->birthDate."'    ,  educationCond='".$m->educationCond."' ,educationLevel='".$m->educationLevel."',educationExpenses='".$m->educationExpenses."' WHERE memberID = ".$_POST['id'];

    n3ml update b2a ll condition
     = "UPDATE inferior SET conditionn = ' " . $i->conditionn."' WHERE memberID= " .$_POST['id'];
    if ($conn->query($sql) === TRUE) {
        $record = "New member is added successfully";
        $sql = "DELETE FROM ezbamember WHERE memberID='". $_POST['id'] ."'";
        header('Location: showezbamember.php');
    } else {
        if ($conn->errno == 1062) {
            $record = "member is already added";
        } else {
            $record = "There is something wrong";
        }
    }
}

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

    <div class="container">
        <br><br>
        <h2>Edit Member</h2>
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?> ">
            Name: <input type="text" name="name" value="<?php echo $memberdetails['name'] ?>" required><br><br>
            Family Name: <input type="text" name="famName" value="<?php echo $memberdetails['famName'] ?>" required><br><br>
            Sex: <label><input type="radio" name="sex" value="<?php echo $memberdetails['sex'] ?>" required> Male</label>
                            <label><input type="radio" name="sex" value="<?php echo $memberdetails['sex'] ?>"> Female</label><br><br>
            Birth Date: <input type="text" name="birthDate" value="<?php echo $memberdetails['birthDate'] ?>" required><br><br>
            Education Condition: <input type="text" name="educationCond" value="<?php echo $memberdetails['educationCond'] ?>" required><br><br>
            Education Level: <input type="text" name="educationLevel" value="<?php echo $memberdetails['educationLevel'] ?>" required><br><br>
            educationExpenses: <input type="text" name="educationExpenses" value="<?php echo $memberdetails['educationExpenses'] ?>" required><br><br>
            Condition: <input type="text" name="condition" value="<?php echo $condition['condition'] ?>" required><br><br>
            
            <div class="row">
                <<?php echo $condition; ?>>
                <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Edit">
                <a href="family.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
            </div>
        </form>
    </div>
    <?= $record ?>
</body>
</html>