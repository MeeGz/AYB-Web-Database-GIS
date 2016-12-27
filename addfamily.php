<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
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
    $sql = "INSERT INTO family (houseCode, floorNo, appartmentNo, roof) VALUES ('$m->houseCode', '$m->floorNo', '$m->appartmentNo', '$m->roof')";
    if ($conn->query($sql) === TRUE) {
        $record = "New family is added successfully";
    } else {
        if ($conn->errno == 1062) {
            $record = "Family is already added";
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
        <h2>Add Family</h2>
        <form class="form-horizontal"  style ="padding :20px" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div style ="border-radius :25px "class ="well well-lg col-md-8 col-md-offset-2">
		<div class="col-md-offset-2" >
		  <div class="form-group">	
						<label for ="code"  class="col-md-3 " > House Code: </label>
						<input type="text" name="houseCode" id="code" class="col-md-4  "  required><br>
			</div>
			<div class="form-group">	
						<label for ="floor"  class="col-md-3 " > Floor No.: </label>
						<input type="text" name="floorNo" id="floor" class="col-md-4  "  ><br>
			</div>
			<div class="form-group">	
						<label for ="appart"  class="col-md-3 " > Appartment No.:</label>
						<input type="text" name="appartmentNo" id="appart" class="col-md-4  " ><br>
			</div>
			
		    <div class="form-group">	
						 <label for ="r" class="col-md-3 " > Roof Condition: </label>
						 <div class="col-md-4">
						 <label class="radio-inline"><input type="radio" name="roof" id ="r" value="yes" > Yes</label>
						 <label class="radio-inline"><input type="radio" name="roof" id="r" value="no"> No</label>
						</div>
			</div>
			</div>
			</div>	
            <div class="form-group col-md-12">
                <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Add Family">
                <a href="family.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
            </div>
        </form>
    </div>
    <?= $record ?>
</body>
</html>