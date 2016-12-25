<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
} 