<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
} 
$sql = "SELECT * FROM project";
$project_array = $conn->query($sql);
$sql = "SELECT * FROM aybmember WHERE AYBMemberID='".$_GET['id']."'";
$aybmemberdetails = $conn->query($sql);
$aybmemberdetails = $aybmemberdetails->fetch_assoc();
$project_exist = array();
$sql = "SELECT projectID FROM manage WHERE AYBMemberID='".$_GET['id']."'";
$projectIDs = $conn->query($sql);
while($projectID = $projectIDs->fetch_assoc()){
	$sql = "SELECT projectName FROM project WHERE projectID='".$projectID['projectID'][0]."'";
	$projects = $conn->query($sql);
	$project = $projects->fetch_all();
	$project_exist[] = $project[0][0];
}
class AYBMember{
    public $name;
    public $phone;
    public $email;
    public $university;
    public $faculty;
    public $studyYear;
    public $residence;
    public $AYBYear;
}
$m = new AYBMember;
$record = "";
$sql = "SELECT * FROM project";
$project_array = $conn->query($sql);
if (isset($_POST['name'])) {
    $m->name = $_POST['name'];
    $m->phone = $_POST['phone'];
    $m->email = $_POST['email'];
    $m->university = $_POST['university'];
    $m->faculty = $_POST['faculty'];
    $m->studyYear = $_POST['studyYear'];
    $m->residence = $_POST['residence'];
    if (isset($_POST['AYBYear'])){
        $m->AYBYear = $_POST['AYBYear'];
    }
    $sql = "UPDATE aybmember SET name='".$m->name."',phone='".$m->phone."',email='".$m->email."',university='".$m->university."',faculty='".$m->faculty."',studyYear='".$m->studyYear."',residence='".$m->residence."',AYBYear='".$m->AYBYear."' WHERE AYBMemberID=".$_POST['id'];
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $record = "New member is added successfully";
		$sql = "DELETE FROM manage WHERE AYBMemberID='". $_POST['id'] ."'";
        $res = $conn->query($sql);
        if (isset($_POST['project'])) {
            foreach ($_POST['project'] as $projectID) {
                $sql = "INSERT INTO manage (AYBMemberID,projectID) VALUES ('".$_POST['id']."','".$projectID."')";
                $conn->query($sql);
            }
            header('Location: showaybmember.php');
        }
    } else {
        if ($conn->errno == 1062) {
            $record = "Member is already added";
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
        <div class="row">
            <h2>Edit Member</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?> ">
                Name: <input type="text" name="name" value="<?php echo $aybmemberdetails['name'] ?>" required><br><br>
                Phone Number: <input type="text" name="phone" value="<?php echo $aybmemberdetails['phone'] ?>" required><br><br>
                Email: <input type="text" name="email" value="<?php echo $aybmemberdetails['email'] ?>" required><br><br>
                University: <input type="text" name="university" value="<?php echo $aybmemberdetails['university'] ?>" required><br><br>
                Faculty: <input type="text" name="faculty" value="<?php echo $aybmemberdetails['faculty'] ?>" required><br><br>
                Study Year: <input type="text" name="studyYear" value="<?php echo $aybmemberdetails['studyYear'] ?>" required><br><br>
                Residence: <input type="text" name="residence" value="<?php echo $aybmemberdetails['residence'] ?>" required><br><br>
                AYB Year: <input type="text" name="AYBYear" value="<?php echo $aybmemberdetails['AYBYear'] ?>"><br><br>
                <div class="row">
                    <legend>Participated Projects</legend>
                    <?php while($row = $project_array->fetch_assoc()) {	
                    	$checked= '';
	                	if ( in_array( $row['projectName'],$project_exist) ) {
	            			$checked= 'checked';
	            		} ?>
                        <div class="form-group col-xs-4">                   
                            <label>
                                <input type="checkbox" name="project[]" <?php echo $checked ?> value="<?php echo $row['projectID'] ?>"> 
                                <?php echo $row['projectName'] ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Edit Member">
                    <a href="showaybmember.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
    </div>
</body>
</html>