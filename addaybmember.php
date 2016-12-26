<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
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
    $sql = "INSERT INTO AYBMember (name,phone,email,university,faculty,studyYear,residence,AYBYear) VALUES ('$m->name','$m->phone','$m->email','$m->university','$m->faculty','$m->studyYear','$m->residence','$m->AYBYear')";
    if ($conn->query($sql) === TRUE) {
        $record = "New member is added successfully";
        $last_id = $conn->insert_id;
        if (isset($_POST['project'])) {
            foreach ($_POST['project'] as $projectID) {
                $sql = "INSERT INTO manage (AYBMemberID,projectID) VALUES ('$last_id','$projectID')";
                $conn->query($sql);
            }
        }
    } else {
        if ($conn->errno == 1062) {
            $record = "Member is already added";
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
            <h2>Add member</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Name: <input type="text" name="name" required><br><br>
                Phone Number: <input type="text" name="phone" required><br><br>
                Email: <input type="text" name="email" required><br><br>
                University: <input type="text" name="university" required><br><br>
                Faculty: <input type="text" name="faculty" required><br><br>
                Study Year: <input type="text" name="studyYear" required><br><br>
                Residence: <input type="text" name="residence" required><br><br>
                AYB Year: <input type="text" name="AYBYear"><br><br>
                <div class="row">
                    <legend>Participated Projects</legend>
                    <?php while($row = $project_array->fetch_assoc()) { ?> 
                        <div class="form-group col-xs-4">                   
                            <label>
                                <input type="checkbox" name="project[]" value="<?php echo $row['projectID'] ?>"> 
                                <?php echo $row['projectName'] ?>
                            </label>
                        </div>
                        <?php } ?>
                </div>
                <div class="row">
                    <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Add Member">
                    <a href="crew.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
        <?= $record ?>
    </div>
</body>
</html>