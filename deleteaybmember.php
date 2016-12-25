<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
	header('Location: login.php');
}
$sql = "DELETE FROM aybmember WHERE AYBMemberID=".$_GET['id'];
$res = $conn->query($sql);
header('Location:showaybmember.php');
?>