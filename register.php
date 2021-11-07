<?php 
include "db.php";
include "rand.php";
 $username = $_POST['username'];
 $password = $_POST['password'];
 $number = $_POST['number'];

$select_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '{$username}' OR number = '{$number}'");
$count = mysqli_num_rows($select_query);
 if($count>0){
     echo '
     <div class="alert alert-danger alert-dismissible fade real show" role="alert">
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           <strong>Whoops </strong> user already exists
       </div>
     ';
 } else{
     register_user($username, $number, $password, $profile_pics);
     echo '
     <div class="alert alert-success alert-dismissible fade real show" role="alert">
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           <strong>Success </strong> You have successfully signed up, please login.
       </div>
     ';
 }

?>