<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
	header('Location: login.php');
}
$sql = "DELETE FROM ezbamember WHERE memberID=".$_GET['id'];
$res = $conn->query($sql);
header('Location:showezbamember.php');
?>