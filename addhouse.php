<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
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

    $sql = "INSERT INTO house (area, houseCode, noOfFloors, noOfAppartments, specialSign, sanitation) VALUES ('$m->area', '$m->houseCode', '$m->noOfFloors', '$m->noOfAppartments', '$m->specialSign', '$m->sanitation')";
    if ($conn->query($sql) === TRUE) {
        $record = "New house is added successfully";
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
            <h2>Add House</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                Area: <input type="text" name="area" required><br><br>
                House Code: <input type="text" name="houseCode" required><br><br>
                No. of Floors in House: <input type="text" name="noOfFloors"><br><br>
                No. of Appartments in House: <input type="text" name="noOfAppartments"><br><br>
                Special Sign: <input type="text" name="specialSign"><br><br>
                Sanitation: <label><input type="radio" name="sanitation" value="yes"> Yes</label>
                            <label><input type="radio" name="sanitation" value="no"> No</label>
                <div class="row">
                    <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Add House">
                    <a href="ezba.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
        <?= $record ?>
    </div>
</body>
</html>