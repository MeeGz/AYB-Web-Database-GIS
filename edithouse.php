<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
$sql = "SELECT * FROM house WHERE houseCode='".$_GET['id']."'";
$housedetails = $conn->query($sql);
$housedetails = $housedetails->fetch_assoc();
class house{
    public $area;
    public $houseCode;
    public $noOfFloors;
    public $noOfAppartments;
    public $specialSign;
    public $sanitation;
}
$m = new house;
$record = "";
if (isset($_POST['area'])) {
    $m->area = $_POST['area'];
    $m->houseCode = $_POST['houseCode'];
    $m->noOfFloors = $_POST['noOfFloors'];
    $m->noOfAppartments = $_POST['noOfAppartments'];
    $m->specialSign = $_POST['specialSign'];
    $m->sanitation = $_POST['sanitation'];

    $sql = "UPDATE house SET area='".$m->area."', houseCode='".$m->houseCode."', noOfFloors='".$m->noOfFloors."', noOfAppartments='".$m->noOfAppartments."', specialSign='".$m->specialSign. " ', sanitation=' " .$m->sanitation." ' WHERE houseCode='".$_POST['id']."'";
	if ($conn->query($sql) === TRUE) {
        $record = "New house is added successfully";
        $sql = "DELETE FROM house WHERE houseCode=''".$_GET['id']."'";
        header('Location: showhouse.php');
    } else {
        if ($conn->errno == 1062) {
            $record = "House is already added";
        } else {
            $record = "There is something wrong";
        }
    }
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
            <h2>Edit House</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?> ">
                Area: <input type="text" name="area" value="<?php echo $housedetails['area'] ?>" required><br><br>
                House Code: <input type="text" name="houseCode" value="<?php echo $housedetails['houseCode'] ?>" required><br><br>
                No. of Floors in House: <input type="text" name="noOfFloors" value="<?php echo $housedetails['noOfFloors'] ?>"><br><br>
                No. of Appartments in House: <input type="text" name="noOfAppartments" value="<?php echo $housedetails['noOfAppartments'] ?>"><br><br>
                Special Sign: <input type="text" name="specialSign" value="<?php echo $housedetails['specialSign'] ?>"><br><br>
                Sanitation: <label><input type="radio" name="sanitation" value="<?php echo $housedetails['sanitation'] ?>"> Yes</label>
                            <label><input type="radio" name="sanitation" value="<?php echo $housedetails['sanitation'] ?>"> No</label>
                <div class="row">
                    <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Edit House">
                    <a href="house.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
        <?= $record ?>
    </div>
</body>
</html>