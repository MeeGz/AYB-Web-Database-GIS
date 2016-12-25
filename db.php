<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ezbaAbuQarn";
    // Create connection
    $conn =  mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sSQL= 'SET CHARACTER SET utf8'; 
    mysqli_query($conn,$sSQL) 
    or die ('Can\'t charset in DataBase'); 
    function check($par)
    {
    	if (isset($par) && !empty($par)) {
   			return true;
       	} else{
       		return false;
       	}
    }
 ?>