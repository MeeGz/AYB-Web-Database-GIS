<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
	header('Location: login.php');
}
$sql = "DELETE FROM project WHERE projectID=".$_GET['id'];
$res = $conn->query($sql);
header('Location:showProjects.php');
?>