<?php
include"db.php";
$err = "";
class admin{
        public $username;
        public $password;
    }
    $d = new admin;
    if (isset($_POST['username'])) {
        if (check($_POST['username']) && check($_POST['password']) && check($_POST['repassword']) && $_POST['password'] == $_POST['repassword']) {
            $d->username = $_POST['username'];
            $d->password = $_POST['password'];
            $sql = "INSERT INTO admin (username,password) VALUES ('$d->username','$d->password')";
            if ($conn->query($sql) === TRUE) {
                header('Location: login.php');
            } else {
                if ($conn->errno == 1062) {
                    $err =  "Username already exist";
                }
            }
        } else{
                $err = "There is something wrong";
        }
    }
$conn->close();
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="signup.css">
<title>Sign up</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Sign up</h2>  
            <form name="login" method="post">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        Username: <input type="text" class="form-control" name="username"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        Password: <input type="password" class="form-control" name="password"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        Repeat Password: <input type="password" class="form-control" name="repassword"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-block btn-primary"  name="submit" value="Create New Account">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 already_account"> 
                        <a href="login.php">Already have an account!</a>
                    </div>
                </div>
            </form>
            <div class="row err">
                <h2><?php echo $err; ?></h2>
            </div>
        </div>
    </div>
</body>
</html>