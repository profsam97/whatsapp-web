<?php
include "db.php";
session_destroy();

$_SESSION['id'] = null;
$_SESSION['username'] = null;
$_SESSION['number'] = null;
$_SESSION['images'] = null; 
$_SESSION['password'] = null; 
redirect("login.php");
?>