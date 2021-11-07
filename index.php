<?php include "db.php" ?>
<?php
if(!isLoggedIn()){
    redirect("login.php");
}
$username = get_user_name();
$select_query = mysqli_query($connection, "SELECT * FROM contacts WHERE added_by = '{$username}' ");
$image = 'ddsd';
confirmQuery($select_query);
$notify_query = mysqli_query($connection, "SELECT notifications.froms, users.images FROM notifications  INNER JOIN users ON notifications.froms = users.username WHERE tos = '{$username}' AND isRead = 'false' ");
// $coun = mysqli_num_rows($notify_query);
confirmQuery($notify_query);
		$convos = array();

		$chat_query = mysqli_query($connection, "SELECT user_to, user_from FROM messages WHERE user_to='$username' OR user_from='$username' ORDER BY id DESC");
        $no = mysqli_num_rows($chat_query);
        if($no<1){
            $cont = false;
        }else{
            $cont = true;
        }
		while($row = mysqli_fetch_array($chat_query)) {
			$user_to_push = ($row['user_to'] != $username) ? $row['user_to'] : $row['user_from'];

			if(!in_array($user_to_push, $convos)) {
				array_push($convos, $user_to_push);
			}
            
		}
	
$counts =  mysqli_num_rows($notify_query); 
$select_query = mysqli_query($connection, "SELECT * FROM contacts WHERE added_by = '{$username}' ");
$image = 'ddsd';
confirmQuery($select_query);
if(isset($_POST['real'])){
    if(isset($_POST['checkBoxArray'])) {

        foreach($_POST['checkBoxArray'] as $contact_name ){
            $query = "INSERT INTO status(tagged,images, added_by) VALUES('{$contact_name}', '{$image}', '{$username}')";
            confirmQuery($query);

        }
    }
}
$real_query = mysqli_query($connection, "SELECT statuses.image, statuses.added_by, users.images
FROM statuses
INNER JOIN users ON statuses.added_by = users.username ORDER BY stat_id DESC");
            confirmQuery($real_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"  rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />
    
</head>
<body class ="">
    <div class="well d-flex">
        <div class="col-9 col-md-10">
        <div class="display-4 lead text-black-50 monospace g-0 p-1">WhatsApp</div>
        </div>
        <div class="col-2 col-md-3 p-3">
<div class="dropdown open">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <?php  echo 'Hi ',  ucfirst(get_user_name()) ?>
            </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        <a class="dropdown-item" href="add_contact.php">Add contacts</a>
        <div class="dropdown-divider" role="divider">  </div>
        <a class="dropdown-item " href="logout.php">logout</a>
    </div>
</div>
        </div>
    </div>
<section id="tab" class="bg-success p-2">
      <div class="">
          <div class="container col-md-8 mx-auto">
              <ul class="nav nav-pills ul">
                  <li class="nav-item text-white rea acts  mx-auto">
                      <a  class="nav-link chats   text-light">Chats</a>
                  </li>
                  <li class="nav-item mx-auto mes d-flex">
                      <?php if($counts>0) :?>
               <span class="badge links badge-warning rounded-circle h-50">new</span>
               <?php endif; ?>
               <a class="nav-link status text-light ">Status</a>
                  </li>
                  <li class="nav-item mx-auto">
                      <a href="#" class="nav-link text-light">Calls</a>
                  </li>
              </ul>
          </div>
      </div>
  </section>
  
  <section id="chats">
      <div class="container ">
  <!-- <div class="col-12 opac whit d-flex d-row p-3 d-inline-block">
                <a href="#"  class="g-2">
            <img src="images/person1.jpg" alt=""  class="img-fluid  rounded-circle   h-50 mb-0  ">
        </a>
          <a href="#"  class="text-dark ml-0">
               <div class="mt-0 m- start-0 g-0">
                    <div class="card-body p-0 m-0 ">
                        <div class="card-title p-0 mb-0 m-0 mt-0">
                         <h5 class="m-0 mt-2">Oladejo Samuel            
                     <br class="d-sm-block d-md-none"> </h5>
                        </div>
                            <div class="card-text mt-0 m0">
                            <p class="m-0 lead text-truncate d-inline-block ">Lorem ipsum dolor. </p>
                            <div class="float-end end-0 mt-0 d-inline-block">
                            <small class="text-muted  end-0"> 11 pm</small>
                            </div>
                </div>
                </div>
                </a> 
                <hr>  
        </div> -->
        <?php 
        if($cont){
        foreach($convos as $other_user) {
			 $latest_message_details = getLatestMessage($username, $other_user);
             ;
            ?>
        <div class="col-12 col-md-8 opac whit row p-1 ">
      <div class="col-sm-4 col-4 m-0">
        <a href="<?php echo getProfilePic($other_user)?>" data-toggle="lightbox" data-title="" data-footer="<?php echo $other_user; ?>">
        <img src="<?php echo getProfilePic($other_user)?>" alt=""  class="img-fluid  rounded-circle   h-75 mb-0  "></a>
      </div>
            <div class="col-sm-7 col-7">
            <a href="message.php?username=<?php echo $other_user; ?>"  class="g-2 text-dark">
            <div class="card-body p-0 m-0 float-start">
                 <div class="card-title p-0 mb-0 m-0 ml-0 g-0 mt-0">
              <h5 class="ml-0 mt-3"><?php echo $other_user ?>           
                     <br class="d-sm-block d-md-none"> </h5>
                        </div>
                            <div class="card-text mt-0 m0">
                            <p class="m-0 lead text-truncate d-inline-block "><?php  echo getLatestMessage($username, $other_user)?> </p>
                            <div class="float-end end-0 mt-0 d-inline-block">
                            </div>
                </div>
                </div>
            </a>
                </div>
        </div>
<?php
}
        } else{
            ?>
             <div class ="">
                    <p class ="lead text-center">
           Please click on the below icon to select a contact to chat with. 
    </div>
    <?php 
        }
?>
                </div>
               
        <section id="messagecontacts" class="float-right reals ">
      <div class="border   border-white p-3  ">
      <a  href="message_contact.php" type="submit " class="btn btn-success"> 
      <i class="fas fa-envelope-square   fa-2x "></i>
    </a>
      </div>
  </section>
  </section>
  <section id="status">


  <!-- Modal -->
  <div class="modal oka fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Please select photo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>
              <div class="modal-body">
              <form onsubmit="prevent(event)" method="post"  id ="okay" enctype="multipart/form-data" class="form">
              <div class="mb-3">
                  <label for="formFile" class="form-label"></label>
                  <input required class="form-control" type="file" id="photo" name="fileUpload">
              </div>
              <div class="h6 text-center">Tag friends</div>
            <div id="accordianId" role="tablist" aria-multiselectable="true">
                <div class="card">
                    <div class="card-header" role="tab" id="section1HeaderId">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordianId" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
                      Please select friends
                    </a>
                        </h5>
                    </div>
                    <div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                        <div class="card-body">
                        <table class="table  table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <?php    while($row = mysqli_fetch_assoc($select_query)){
                        $id = $row['id'];
                        $names = $row['names'];
                    ?>
<?php if(isRegisted($names)): ?>
                                <tbody>
                                    <tr>
                                        <td scope="row">
                                        <input type="checkbox" class="checkBoxes" id="" name='checkBoxArray[]' value='<?php echo $names; ?>'>
                                        </td>
                                        <td> <?php echo $names; ?></td>
                                    </tr>
                                </tbody>
                                <?php endif; ?>
                                <?php 
                
};
?>
 </table>
                          
                          <button type="submit" name="real" id="oks" class="btn btn-success float-end">Post</button>
          
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        </form>
                        </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
      <div class="container">
      <?php
  while ($row = mysqli_fetch_assoc($real_query)) {
                $image = $row['image'];
                $added_by = $row['added_by'];
                $profile = $row['images'];
                    ?>
  <div class="col-12 opac whit row p-3 d-flex d-row">
      <div class="col-3">
      <a href="<?php  echo $image; ?>" data-toggle="lightbox" data-title=" Viewing status" data-footer="Uploaded by <?php echo $added_by; ?>">
    <img src="<?php echo $image; ?>" class="img-fluid w-50 h-75">
</a>
      </div>
            <div class="col-9">
       <div class="mt-0 m-0 ">
                    <div class="card-body p-0 m-0">
                    <a class="text-dark" href="<?php  echo $image; ?>" data-toggle="lightbox" data-title=" Viewing status" data-footer="Uploaded by <?php echo $added_by; ?>">
        <div class="card-title p-0 mb-0 m-0 mt-0">
              <h5 class="m-0 mt-2"><?php echo $added_by; ?>                
                        </div>
                    </a>
                </div>
                </div>
                </div>
        </div>

        <?php
        ?>
 <?php  }
?>
        </div>
   

        <div class="border  border-white p-3 float-right reals">
  <button type="button" class="btn btn-success " data-toggle="modal" data-target="#modelId">
    <i class="fas fa-camera   fa-2x "></i>
    </button>
      </div>
  </section>
 <div class="container hello   bottom-0 end-0 float-end" style="z-index: 11">
 </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" 
  crossorigin="anonymous"></script>
<style src = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.js"></script>

<script src="js/script.js"></script>


<style>
          .whit a{
    text-decoration-color: #1a1a1a !important; 
    text-decoration: none !important;
    cursor: pointer;
    text-decoration-line: none !important;

}
.opacs{
    cursor: pointer;
}
.opacs:hover{
    transition: opacity linear 100ms;
    opacity: .8;
}
.opac{
    cursor: pointer;
}
.opac:hover{
    transition: opacity linear 100ms;
    opacity: .8;
}
.acts{
    border-bottom: 3px solid #fff;
    }
.reals{
    position: fixed;
    right: 0px;
    bottom: 0px;
}
.hello{
    position: fixed;
    right: -670px;
    bottom: 20px;
}
body{
    overflow-x: hidden;
    /* overflow-y:scroll; */
}
</style>
<script>
     $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
     function prevent(event){
       event.preventDefault();
       var formData = new FormData($("#okay")[0]);
    //    var form =$('.form').serialize();
    $('#modelId').modal('hide');
       $.ajax({
        url: "status_ajax.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        cache: false,
        success: function(response){
            $('.real').html(response);
            console.log(response)
    //   setTimeout(function () {
    //     location.reload(true);
    //   }, 5000);
        }
    })
    
}
   

    $(document).ready(()=>{
        setInterval(()=>{
            $.ajax({
        url: "notify_ajax.php",
        type: "POST",
        cache: false,
        success: function(response){
            $('.hello').html(response);
        }
        })
        },300)
    })
</script>
</body>
</html>