<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
class ezbaMember{
    public $familyid;
    public $name;
    public $famname;
    public $sex;
    public $birthdate;
    public $educationcond;
    public $educationlevel;
    public $educationexpenses;
}
$m = new ezbaMember;
$record = "";
$sql = "SELECT * FROM project";
$project_array = $conn->query($sql);
if (isset($_POST['name'])) {
    $m->familyid = $_POST['familyid'];
    $m->name = $_POST['name'];
    $m->famname = $_POST['famname'];
    $m->sex = $_POST['sex'];
    $m->birthdate = $_POST['birthdate'];
    $m->educationcond = $_POST['educationcond'];
    $m->educationlevel = $_POST['educationlevel'];
    $m->educationexpenses = $_POST['educationexpenses'];
    $sql = "INSERT INTO ezbamember (familyid,name,famname,sex,birthdate,educationcond,educationlevel,educationexpenses) VALUES ('$m->familyid','$m->name','$m->famname','$m->sex','$m->birthdate','$m->educationcond','$m->educationlevel','$m->educationexpenses')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        for ($i=0; $i < 10; $i++) { 
            $phoneid = 'phone' . $i;
            $skillid = 'skill' . $i;
            if (isset($_POST[$phoneid]) && !empty($_POST[$phoneid])) {
                $sql = "INSERT INTO telephone (memberID,telephoneNo) VALUES ('$last_id','$_POST[$phoneid]')";

                if ($conn->query($sql) === TRUE) {
                    $record = "New member is added successfully";
                    if (isset($_POST[$skillid]) && !empty($_POST[$skillid])) {
                        $sql = "INSERT INTO skills (memberID,skill) VALUES ('$last_id','$_POST[$skillid]')";

                        if ($conn->query($sql) === TRUE) {
                            $record = "New member is added successfully";
                        } else {
                            $record = "There is something wrong";
                            $sql = "Delete FROM ezbamember WHERE memberID = '$last_id'";
                            $res = $conn->query($sql);
                        }
                    }
                } else {
                    $record = "There is something wrong";
                    $sql = "Delete FROM ezbamember WHERE memberID = '$last_id'";
                    $res = $conn->query($sql);
                }
            }
        }
        if (isset($_POST['project'])) {
            foreach ($_POST['project'] as $projectID) {
                $sql = "INSERT INTO participate (memberID,projectID) VALUES ('$last_id','$projectID')";
                $conn->query($sql);
            }
        }
        if (isset($_POST['membertype']) && !empty($_POST['membertype'])) {
            if ($_POST['membertype'] == 'superior') {
                $sql = "INSERT INTO superior (memberID,income,work) VALUES ('".$last_id."','".$_POST['income']."','".$_POST['work']."')";
                if ($conn->query($sql) === TRUE) {
                    $record = "New member is added successfully";
                } else {
                    $record = "There is something wrong";
                    $sql = "Delete FROM ezbamember WHERE memberID == '$last_id'";
                    $res = $conn->query($sql);
                }
                $sql = "SELECT familyIncome FROM family WHERE familyid = " . $_POST['familyid'];
                $result = $conn->query($sql);
                $result = $result->fetch_all();
                $result = (int)$result[0][0];
                $familyIncome = $result + $_POST['income'];
                $sql = "UPDATE family SET familyIncome = " . $familyIncome . " WHERE familyID = " . $_POST['familyid'];
                $result = $conn->query($sql);
                $sql = "SELECT noFamilyMembers FROM family WHERE familyid = " . $_POST['familyid'];
                $result = $conn->query($sql);
                $result = $result->fetch_all();
                $result = (int)$result[0][0];
                $noFamilyMembers = $result + 1;
                $sql = " UPDATE family SET noFamilyMembers = " . $noFamilyMembers . " WHERE familyID = " . $_POST['familyid'];
                $result = $conn->query($sql);
            } else {
                $sql = "INSERT INTO inferior (memberID,conditionn) VALUES ('".$last_id."','".$_POST['condition']."')";
                if ($conn->query($sql) === TRUE) {
                    $record = "New member is added successfully";
                } else {
                    $record = "There is something wrong";
                    $sql = "Delete FROM ezbamember WHERE memberID == '$last_id'";
                    $res = $conn->query($sql);
                }
            }
        }
    } else {
        $record = "There is something wrong";
    }
}
$conn->close();
?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        var countphone =1;
        var countskill =1;
        function addPhone()
        {
            document.getElementById('anotherphone').innerHTML+='<input type="text" name="phone' + countphone + '" id="'+countphone+'" value="" /><br><br>';
             countphone += 1;
        }
        function addSkill()
        {
            document.getElementById('anotherskill').innerHTML+='<input type="text" name="skill' + countskill + '" id="'+countskill+'" value="" /><br><br>';
             countskill += 1;
        }
        function superior()
        {
            document.getElementById('membertypee').innerHTML='Skills: <input type="text" name="skill0" required>'+
                        '<input type="button" onclick="addSkill()" value="+" />'+
                        '<br><br>'+
                        '<span id="anotherskill"></span>'+
                'Work: <input type="text" name="work" required><br><br>'+
                'Income: <input type="text" name="income" required><br><br>';
        }
        function inferior()
        {
            document.getElementById('membertypee').innerHTML='Condition: <input type="text" value= " " name="condition" required><br><br>';
        }
    </script>
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
                Famname:<input type="text" name="famname" required><br><br>
                Sex:    <label><input type="radio" name="sex" value="male" required>Male</label>
                        <label><input type="radio" name="sex" value="female">Female</label><br><br>
                Phone:  <input type="text" name="phone0" required>
                        <input type="button" onclick="addPhone()" value="+" />
                        <br><br>
                        <span id="anotherphone"></span>
                Family id: <input type="text" name="familyid" required><br><br>
                Birthdate: <input type="text" name="birthdate" required><br><br>
                Education Condition: <input type="text" name="educationcond" required><br><br>
                Education Level: <input type="text" name="educationlevel" required><br><br>
                Education Expenses: <input type="text" name="educationexpenses" required><br><br>
                Member Type: <label><input type="radio" onclick="superior().one" name="membertype" value="superior" required> Superior</label>
                             <label><input type="radio" onclick="inferior().one" name="membertype" value="inferior" required> Inferior</label><br><br>
                <span id="membertypee"></span>
                <div class="row">
                    <legend>projects</legend>
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
                    <a href="ezbamember.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
        <?= $record ?>
    </div>
</body>
</html>