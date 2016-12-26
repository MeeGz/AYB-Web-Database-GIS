<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
$sql = "SELECT * FROM project WHERE projectID='".$_GET['id']."'";
$projectdetails = $conn->query($sql);
$projectdetails = $projectdetails->fetch_assoc();
class project
{
    public $projectName;
}

$p = new project;
$record = "";
if (isset($_POST['projectName'])) 
{
	$p->projectName = $_POST['projectName'];
	$sql = "UPDATE project SET projectName='" . $p->projectName . "' WHERE projectID = " .$_POST['id'];
	//echo $sql;
	if ($conn->query($sql) === TRUE) 
	{
        $record = "New project is added successfully";
        $sql = "DELETE FROM project WHERE projectID='". $_POST['id'] ."'";
        header('Location: showProjects.php');
    } 
	else 
	{
        if ($conn->errno == 1062) 
		{
            $record = "Project is already added";
        } 
		else 
		{
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
            <h2>Edit Project</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?> ">
                Project Name: <input type="text" name="projectName" value="<?php echo $projectdetails['projectName'] ?>" required><br><br>
                <div class="row">
                    <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Edit Project">
                    <a href="showProjects.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
    </div>
</body>
</html>