<?php 
include "db.php";
$user_to = $_POST['user_to'];
$body = $_POST['body'];
$username = get_user_name();

$insert_query = mysqli_query($connection, "INSERT INTO messages VALUES('','{$user_to}', '{$username}', '{$body}')");
confirmQuery($insert_query);
?>