<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
	header('Location: login.php');
}
$sql = "DELETE FROM family WHERE familyID=".$_GET['id'];
$res = $conn->query($sql);
header('Location:showfamily.php');
?>