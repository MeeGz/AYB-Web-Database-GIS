<?php 
include"db.php";
if (isset($_COOKIE['admin']) && $_COOKIE['admin'] != null) {
    header('Location: interface.php');
}
$wrong = '';
if (isset($_POST['username'])
    && isset($_POST['password'])
    && !empty($_POST['username'])
    && !empty($_POST['password'])) {
    $sql = "SELECT * FROM admin WHERE username ='". $_POST['username'] . "' AND password ='". $_POST['password'] ."'";
    $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        if (isset($_POST['rememberme'])) {
            /* Set cookie to last 1 year */
            setcookie('admin', $_POST['username'], time()+60*60*24*30*12);
        } else {
            /* Cookie expires when browser closes */
            setcookie('admin', $_POST['username'], time()+60*60*24);
        }
        header('Location: interface.php');
     } else{
        $wrong = 'Username or/and Password is/are Invalid';
     }
}
$conn->close();
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Login</h2>  
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
                        <input type="checkbox" name="rememberme" value="1"> Remember Me<br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6"> 
                    <?php if ($wrong != ""): ?>
                        <div class="alert alert-danger">
                        <?php echo $wrong; ?>
                        </div>
                    <?php endif ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-block btn-primary"  name="submit" value="Login!">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 create_account"> 
                        <a href="signup.php">Create new account!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>