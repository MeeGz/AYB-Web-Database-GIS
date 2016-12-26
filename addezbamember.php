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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/add.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {margin: 0;
            margin-top: 50px;
            font-family: "Lato", sans-serif;}

        ul.topnav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        ul.topnav li {float: left;}

        ul.topnav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.topnav li a:hover:not(.active) {background-color: #111;}

        ul.topnav li a.active {background-color: #4CAF50;}

        ul.topnav li.right {float: right;}
        td{
            direction: rtl;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even){background-color: #f2f2f2}
        a{
            text-align: center
        }
        img{
            height: 50px;
        }
        th{
            width: 11%;
            background-color: silver;
        }
        td {
            word-break: break-all;
        }
        span{
            font-size: 20px;
        }
        .mySlides {display: none}
        .demo {cursor:pointer}
        .w3-left, .w3-right, .w3-badge {cursor:pointer}
        .w3-badge {height:13px;width:13px;padding:0}
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="w3-top">
        <ul class="w3-navbar w3-black w3-card-2 w3-left-align">
          <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
            <a class="w3-padding-large" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          </li>
          <li><a href="interface.php" class="w3-padding-large">HOME</a></li>
          <li class="w3-hide-small"><a href="crew.php" class="w3-padding-large">CREW</a></li>
          <li class="w3-hide-small"><a href="project.php" class="w3-padding-large">PROJECTS</a></li>
          <li class="w3-hide-small w3-dropdown-hover">
            <a href="javascript:void(0)" class="w3-hover-none w3-padding-large" title="More"> EZBA <i class="fa fa-caret-down"></i></a>     
            <div class="w3-dropdown-content w3-white w3-card-4">
              <a href="house.php">Houses</a>
              <a href="family.php">Families</a>
              <a href="ezbamember.php">Ezba People</a>
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
          <li class="w3-hide-small w3-right"><a class="w3-hover-none w3-hover-text-grey w3-padding-large"><?php echo $_COOKIE["admin"]; ?></a></li>
        </ul>
    </div>
<!-- end of navbar -->
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
                    <legend>Projects affecting him/her</legend>
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