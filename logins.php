<?php 
include "db.php";
include "rand.php";
 $username = $_POST['username'];
 $password = $_POST['password'];
$select_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '{$username}'");
$count = mysqli_num_rows($select_query);
 if($count<1){
     echo '
     <div class="alert alert-danger alert-dismissible fade real show" role="alert">
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           <strong>Whoops </strong> invalid details
       </div>
     ';
 } else{
        
     if(login_user($username, $password)){
     
    echo "<script>window.location.href='index.php';</script>";
    exit;
     };
  
 }


?>