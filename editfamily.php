<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}

$sql = "SELECT * FROM family WHERE familyID ='".$_GET['id']."'";
$familydetails = $conn->query($sql);
$familydetails = $familydetails->fetch_assoc();

class family{
    public $houseCode;
    public $noFamilyMembers;
    public $floorNo;
    public $appartmentNo;
    public $familyIncome;
    public $roof;
}
$m = new family;
$record = "";
if (isset($_POST['houseCode'])) {
    $m->houseCode = $_POST['houseCode'];
    $m->floorNo = $_POST['floorNo'];
    $m->appartmentNo = $_POST['appartmentNo'];
    $m->roof = $_POST['roof'];
    
    $sql = "UPDATE family SET houseCode = '".$m->houseCode."', floorNo='".$m->floorNo."', appartmentNo='".$m->appartmentNo."', roof='".$m->roof."' WHERE familyID = ".$_POST['id'];

    if ($conn->query($sql) === TRUE) {
        $record = "New family is added successfully";
        $sql = "DELETE FROM family WHERE familyID='". $_POST['id'] ."'";
        header('Location: showfamily.php');
    } else {
        if ($conn->errno == 1062) {
            $record = "Family is already added";
        } else {
            $record = "There is something wrong";
        }
    }
}

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
        <h2>Edit Family</h2>
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?> ">
            House Code: <input type="text" name="houseCode" value="<?php echo $familydetails['houseCode'] ?>" required><br><br>
            Floor No.: <input type="text" name="floorNo" value="<?php echo $familydetails['floorNo'] ?>"><br><br>
            Appartment No.: <input type="text" name="appartmentNo" value="<?php echo $familydetails['appartmentNo'] ?>"><br><br>
            Roof Condition: <label><input type="radio" name="roof" value="<?php echo $familydetails['roof'] ?>"> Yes</label>
                            <label><input type="radio" name="roof" value="<?php echo $familydetails['roof'] ?>"> No</label>
            <div class="row">
                <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Edit Family">
                <a href="family.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
            </div>
        </form>
    </div>
    <?= $record ?>
</body>
</html>