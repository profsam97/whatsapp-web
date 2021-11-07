<?php 
include "db.php";
 $user_to = $_POST['data'];
$username = get_user_name();
$select_query = mysqli_query($connection, "SELECT * FROM messages  WHERE user_to = '{$user_to}' AND user_from = '{$username}' OR  user_to = '{$username}' AND user_from = '{$user_to}' ");
confirmQuery($select_query);
while($row=mysqli_fetch_assoc($select_query)){
    $user_to = $row['user_to'];
    $user_from = $row['user_from'];
    $message = $row['body'];   
$data ='';
// $div_top = ($user_to == $username) ? "
// <p class='placeholder header'>
// <div class='float-start'>
// <p class='float-start border scroll_messages  bg-dark rounded bg-success  text-light p-2 w-100 border-success'>
// {$message}
// </p>
// </div> <br><br>
// </p>" : "
//         <div class='float-end mx-4'>
//         <p class='float-end border rounded bg-success  text-light p-2 w-100  border-success scroll_messages'>
//         {$message}
//         </p>
//         </div> <br><br>
//         </p>";
//         echo $div_top;
// }

$div_top = ($user_to == $username) ? "<div class='message' id='green'>" : "<div class='message' id='blue'>";

$data = $data . $div_top  . $message . "</div><br><br>";
echo $data;
}
?>