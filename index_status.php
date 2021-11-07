<?php include "db.php" ?>
<?php
$username = get_user_name();
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
INNER JOIN users ON statuses.added_by = users.username");
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
<body>
    <div class="well d-flex">
        <div class="col-md-10">
        <div class="display-6 lead text-black-50 monospace g-0 p-1">WhatsApp</div>
        </div>
        <div class="col-md-2 p-3">
<div class="dropdown open">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <?php  echo 'Hi ',  ucfirst(get_user_name()) ?>
            </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        <button class="dropdown-item" href="#">Add to contact</button>
        <div class="dropdown-divider" role="divider">  </div>
        <button class="dropdown-item " href="#">logout.php</button>
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
                  <li class="nav-item mx-auto mes">
                      <a class="nav-link status text-light ">Status</a>
                  </li>
                  <li class="nav-item mx-auto">
                      <a href="#" class="nav-link text-light">Calls</a>
                  </li>
              </ul>
          </div>
      </div>
  </section>
  <!-- Modal -->
  <!-- Button trigger modal -->
  <!-- Button trigger modal -->
  <div class="border   border-white p-3 float-right  ">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
    
    <i class="fas fa-camera   fa-2x "></i>
    </button>
      </div>
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                      Section 1
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
                          
                          <button type="submit" name="real" class="btn btn-success float-end">Post</button>
          
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
  <section id="status">
      <div class="container">
      <?php
  while ($row = mysqli_fetch_assoc($real_query)) {
                $image = $row['image'];
                $added_by = $row['added_by'];
                $profile = $row['images'];
                    ?>
  <div class="col-8 opac whit row p-3">
      <div class="col-sm-4">
      <a href="<?php  echo $image; ?>" data-toggle="lightbox" data-title=" Viewing status" data-footer="Uploaded by <?php echo $added_by; ?>">
    <img src="<?php echo $image; ?>" class="img-fluid">
</a>
      </div>
            <div class="col-sm-7">
       <div class="mt-0 m-0 ">
                    <div class="card-body p-0 m-0">
        <div class="card-title p-0 mb-0 m-0 mt-0">
              <h5 class="m-0 mt-0"><?php echo $added_by; ?>                
                        </div>
                </div>
                </div>
                </div>
                </a> 
        </div>

        <?php
        ?>
 <?php  }
?>
        </div>
    
  </section>
 


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" 
  crossorigin="anonymous"></script>
<style src = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.js"></script>
<script>
    function prevent(event){
       event.preventDefault();
       var formData = new FormData($("#okay")[0]);
    //    var form =$('.form').serialize();
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
</script>
</body>
</html>