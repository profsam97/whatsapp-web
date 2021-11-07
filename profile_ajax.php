<?php
include   "db.php";
if ($_FILES['fileUpload']['size']>0){
  $count = true;
}else{
  $count = false;
}
if(isset($_FILES['fileUpload'])){
  $file = $_FILES['fileUpload']['tmp_name'];
  $target_path = "images/icons";
  $target_file = $target_path . "/" . basename($_FILES["fileUpload"]["name"]);
  move_uploaded_file($file,$target_file);
}
$username = get_user_name();
if($count && !empty($_POST['number'])){
   $number = $_POST['number'];
$query = "UPDATE users SET images = '{$target_file}', number = '{$number}' WHERE username = '{$username}'";
$update_query = mysqli_query($connection, $query);
confirmQuery($update_query);
echo '<script>location.reload()</script>';
} 
 else if ($count && (empty($_POST['number']))){
  $query = "UPDATE users SET images = '{$target_file}' WHERE username = '{$username}'";
  $update_query = mysqli_query($connection, $query);
  confirmQuery($update_query);
  echo '<script>location.reload()</script>';
}
else if (!$count && !empty($_POST['number'])){
  $number = $_POST['number'];
    $query = "UPDATE users SET number = {$number} WHERE username = '{$username}'";
    $update_query = mysqli_query($connection, $query);
    confirmQuery($query);
    echo '<script>location.reload()</script>';
}
else{
  echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Whoops, you need to update at least one field</strong> 
  </div>';
}
 

  
  
