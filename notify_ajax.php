<?php 
include "db.php";
$username = get_user_name();
$notify_query = mysqli_query($connection, "SELECT notifications.froms, notifications.id, users.images FROM notifications  INNER JOIN users ON notifications.froms = users.username WHERE tos = '{$username}' AND isRead = 'false' ");
confirmQuery($notify_query);
while($row=mysqli_fetch_assoc($notify_query)){
    $tagged_by = $row['froms'];
    $user_image = $row['images'];
    $id= $row['id'];

?>

<div class="p-3" >
<div id="liveToast" data-bs-autohide="false" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <img src="images/<?php echo $user_image; ?>" class="rounded me-2 w-25 h-25" alt="...">
        <strong class="mx-auto me-auto">new notification</strong>
        <small>Some moments ago</small>
        <button type="button" class="btn-close" onclick="hideToast(<?php echo $id?>)" data-bs-dismiss="toast" aria-label="Close"><i class="fas fa-window-close"></i>
</button>
    </div>
    <div class="toast-body">
        <?php echo ucfirst(get_user_name()) . " , " . ucfirst($tagged_by) . " tagged you.";?>
    </div>
</div>
</div>
<?php 
}
?>
<script>
     function hideToast(id) {
        $.ajax({
        url: "delete_notify_ajax.php",
        type: "POST",
        data: {data:id},
        cache: false,
        success: function(response){
            console.log(response);
        }
        })
    }
</script>