<?php 
include "db.php";
$id = $_POST['data'];
$delete_query = mysqli_query($connection, "DELETE FROM notifications WHERE id = '{$id}' ");
confirmQuery($delete_query);
?>
