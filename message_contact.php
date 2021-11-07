<?php 
include "db.php";
$username = get_user_name();
$select = mysqli_query($connection, "SELECT * FROM contacts WHERE added_by = '{$username}'");
confirmQuery($select);
$no = mysqli_num_rows($select);
if($no>0){
    $count = true;
}else{
    $count = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"  rel="stylesheet">
    
</head>
<body>
    <div class="container m-2 text-center">
        <h5 class="lead">Please choose the contact you want to chat with</h5>
            <div class="d-flex d-column">
<?php 
    if($count){
    while ($row = mysqli_fetch_assoc($select)) {
                $id = $row['id']; 
                $name = $row['names']; 
                if(isRegisted($name)){
                    $check = '';
                }
                else{
                    $check = 'disabled';
                }
    ?>
   <div class="col-12 opac whit" >
       <div class="d-flex">
       <div class="col-4">
                <a href="message.php?username=<?php echo $name ?>"  class="g-2 btn h-75  <?php echo $check; ?>">
            <img src="images/<?php echo getProfilePic($name); ?>" alt=""  class="img-fluid  rounded-circle   h-75 mb-0  ">
        </a>
        </div>
        <div class="col-8">
        <div class="mt-4 float-start start-0 g-0">
          <a href="message.php?username=<?php echo $name ?>"  class="text-dark ml-0 btn <?php echo $check; ?>">
          <?php echo $name;?>

                    <div class="card-body p-0 m-0 ">
                        <div class="card-title p-0 mb-0 m-0 mt-0">
                            <?php if(!isRegisted($name)): ?>
                       <small class="text-muted">Not registered</small>
                       <?php endif; ?>
                         <h5 class="m-0 mt-2">           
                     <br class="d-sm-block d-md-none"> </h5>
                        </div>
                            <div class="card-text mt-0 m0">
                </div>
                </a> 
                </div>
                </div>
                </div>
                <hr>  
        </div>
        <?php
        ?>

        <div class="borders-top1 ml-4 r"></div>
 <?php  }

                            } 
                            else{
                                ?>
        <div class ="text-center mx-auto">
      <p class ="lead text-center">
   Empty Contact!  Please click on the below icon to add a contact. 
                        </div>
                        <?php 
                            }
        ?>
</div>
    </div>
  

   <?php  if(!$count){

   ?>
    <section id="messagecontacts" class="float-right reals ">
      <div class="border   border-white p-3  ">
      <a  href="add_contact.php" type="submit " class="btn btn-success"> 
      <i class="fas fa-plus   fa-2x "></i>
    </a>
      </div>
  </section>
   <?php 
   }
   ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.js"></script>

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
.reals{
    position: fixed;
    right: 0px;
    bottom: 0px;
}

</style>
<script>
     function hideToast() {
        var toastDOMElement = document.getElementById("liveToast");
        var myToast = new bootstrap.Toast(toastDOMElement);
        myToast.hide();
    }
</script>
</body>
</html>