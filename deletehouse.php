<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
	header('Location: login.php');
}
$sql = "DELETE FROM house WHERE houseCode=".$_GET['id'];
$res = $conn->query($sql);
header('Location:showhouse.php');
?>