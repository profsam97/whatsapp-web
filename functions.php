<?php 
function confirmQuery($result){
if(!$result ) {
	global $connection;
	die("QUERY FAILED ." . mysqli_error($connection));

}
}
function isRegisted($name){
	global $connection;
	$select_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '{$name}'");
    confirmQuery($select_query);
	$count = mysqli_num_rows($select_query);
	if($count>0){
		return true;
	}else{
		return false;
	}
}


function register_user($username, $number, $password, $images){

    global $connection;

        $username = mysqli_real_escape_string($connection, $username);
        $number    = mysqli_real_escape_string($connection, $number);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            
        $query = "INSERT INTO users (username, number, password,images) ";
        $query .= "VALUES('{$username}','{$number}',  '{$password}', '{$images}')";
        $register_user_query = mysqli_query($connection, $query);

        confirmQuery($register_user_query);

        $_SESSION['username'] = $username;
}
function redirect($location){
    header("Location: " . $location);
    exit;
}
function get_user_name(){
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

function isLoggedIn(){
    if(isset($_SESSION['username'])){
        return true;
    }
   return false;
}
function getLatestMessage($username, $other_user){
    global $connection;
    $query = mysqli_query($connection, "SELECT * FROM messages WHERE user_to = '{$other_user}' AND user_from = '{$username}' OR  user_to = '{$username}' AND user_from = '{$other_user}' ORDER BY id DESC LIMIT 1");
    confirmQuery($query);    
    $row = mysqli_fetch_assoc($query);
    $message = $row['body'];
    return $message;   
}
function getProfilePic($username){
    global $connection;
    $query = mysqli_query($connection, "SELECT images FROM users  WHERE username = '{$username}' ");
    $row = mysqli_fetch_assoc($query);
    confirmQuery($query);    
    $profile_pic = $row['images'];
    return $profile_pic;   
}
function login_user($username, $password)
 {

     global $connection;

     $username = trim($username);
    //  $password = trim($password);

     $username = mysqli_real_escape_string($connection, $username);
    //  $password = mysqli_real_escape_string($connection, $password);


     $query = "SELECT * FROM users WHERE username = '{$username}' ";
     $select_user_query = mysqli_query($connection, $query);
     
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($connection));

     }


     while ($row = mysqli_fetch_array($select_user_query)) {

         $db_user_id = $row['id'];
         $db_username = $row['username'];
         $db_user_password = $row['password'];
         $number = $row['number'];
         $images = $row['images'];
         if (password_verify($password,$db_user_password)) {
             $_SESSION['id'] = $db_user_id;
             $_SESSION['username'] = $db_username;
             $_SESSION['number'] = $number;
             $_SESSION['images'] = $images;         

                return true;
         } 
         else {

            // $pass_error = "false";
            // return $pass_error;
            // return false;
            return false;

         }



     }

     return true;

 }
?>