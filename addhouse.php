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
            <form class="form-horizontal"  style ="padding :20px" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div style ="border-radius :25px "class ="well well-lg col-md-8 col-md-offset-2">
				<div class="col-md-offset-2" >
			   <div class="form-group">	
						<label for ="area"  class="col-md-3 " > Area: </label>
						<input type="text" name="area" id="area" class="col-md-4  "  required><br>
				</div>
				<div class="form-group">	
						<label for ="code"  class="col-md-3 " >  House Code:  </label>
						<input type="text" name="houseCode" id="code" class="col-md-4  "  required><br>
				</div>
				<div class="form-group">	
						<label for ="floors"  class="col-md-3 " >   No. of Floors in House:  </label>
						<input type="text" name="noOfFloors" id="floors" class="col-md-4  "  required><br>
				</div>
				<div class="form-group">	
						<label for ="appartments"  class="col-md-3 " >   No. of Appartments in House:  </label>
						<input type="text" name="noOfAppartments" id="appartments" class="col-md-4  "  ><br>
				</div>
                <div class="form-group">	
						<label for ="sign"  class="col-md-3 " >   Special Sign:  </label>
						<input type="text" name="specialSign" id="sign" class="col-md-4  "  ><br>
				</div>
                
                <div class="form-group">	
						 <label for ="sign" class="col-md-3 " > Sanitation: </label>
						 <div class="col-md-4">
						 <label class="radio-inline"><input type="radio" name="sanitation" id ="sign" value="yes" class="  "> Yes</label>
						 <label class="radio-inline"><input type="radio" name="sanitation" id="sign" value="no"> No</label>
						</div>
				</div>
                </div>
				</div>
               
                            
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Add House">
                    <a href="house.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
        <?= $record ?>
    </div>
</body>
</html>