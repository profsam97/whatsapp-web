<?php
include   "db.php";
$username = get_user_name();
$image = 'ddsd';
$contact_name = 'dsd';
$file = $_FILES['fileUpload']['tmp_name'];
$target_path = "images/status/";
$target_file = $target_path . basename($_FILES["fileUpload"]["name"]);
// $query = "INSERT INTO statuses(tagged,images, added_by) VALUES('{$contact_name}', '{$image}', '{$username}')";
// $query = "INSERT INTO statuses(tagged,image,added_by) ";     
// $query .= "VALUES('{$contact_name}','{$image}','{$username}') "; 
// $connect_query = mysqli_query($connection, $query);
// confirmQuery($connect_query);
// $this->filename = basename($file['name']);
// $this->type = $file['type'];
// $this->size = $file['size'];
// $this->tmp_path = $file['tmp_name'];
move_uploaded_file($file, $target_file);

if(isset($_POST['checkBoxArray'])) {
   foreach($_POST['checkBoxArray'] as $contact_name){
            $query = "INSERT INTO statuses(tagged,image, added_by) VALUES('{$contact_name}', '{$target_file}', '{$username}')";
            $connect_query = mysqli_query($connection, $query);
            confirmQuery($connect_query);
            $noti_query = "INSERT INTO notifications(tos,froms,isRead) VALUES('{$contact_name}', '{$username}', 'false')";
            $connects_query = mysqli_query($connection, $noti_query);
            confirmQuery($connects_query);
        }
    }
?>