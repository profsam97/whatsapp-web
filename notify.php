<?php
include   "db.php";
 $username = get_user_name();
 $update_query = mysqli_query($connection, "UPDATE notifications SET isRead = 'true'  WHERE tos = '{$username}' ");
    confirmQuery($update_query);
?>