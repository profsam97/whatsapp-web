<?php
include   "db.php";
 $username = $_POST['full_name'];
 $number = $_POST['number'];
 $added_by = get_user_name();
 $select_query = mysqli_query($connection, "SELECT * FROM contacts WHERE names = '{$username}' AND added_by ='{$added_by}' OR phone_no = $number");
 $count = mysqli_num_rows($select_query);
  if($count>0){
      echo '
      <div class="alert alert-danger alert-dismissible fade real show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Whoops </strong> Contacts already exists
        </div>
      ';
  } else{
    confirmQuery($select_query);
    $query = "INSERT INTO contacts(names,phone_no, added_by) VALUES('{$username}', '{$number}', '{$added_by}')";
     $insert_query=  mysqli_query($connection, $query);
     echo 
     '
     <div class="alert alert-primary alert-dismissible fade real show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Successfully added</strong> You have successfully aded the contact
        </div>
     '
     ;
  }


?>