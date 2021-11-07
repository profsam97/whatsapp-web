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
        <div class=" real" >
        
        </div>
        
    <div class="container mt-5">
    <div class="card border-success mb-1 mb-5" style="max-width: 108rem; ">
        <div class="card-header text-center">Add contacts</div>
        <div class="card-body text-success">
        <form  class="form" method="form" onsubmit="prevent(event)">
        <div class="form-floating ">
                    <input type="text" class="form-control" required  id="floatingInputValue" placeholder="name@example.com" value="" name="full_name">
                    <label for="floatingInputValue">Enter name</label>
                </div>
                <br>
        <div class="form-floating ">
                    <input type="number" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="" name="number" required >
                    <label for="floatingInputValue">Enter  number</label>
                </div>
                <br>
                <button type="submit"  class="float-start mt-4 w-100 btn btn-success btn-lg">Add</button>
            </form>
        </div>
    </div>
    <section id="goHome" class="text-center mt-5 ">
      <div class="border   border-white p-3  ">
      <a  href="index.php" type="submit " class="btn btn-success"> 
      <i class="fas fa-home   fa-2x "></i>
    </a>
      </div>
  </section>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.js"></script>
<script>
        function prevent(event){
       event.preventDefault();
       var form =$('.form').serialize();
       $.ajax({
        url: "add_contact_ajax.php",
        type: "POST",
        data: form,
        cache: false,
        success: function(response){
            $('.real').html(response);
            console.log(response)
      setTimeout(function () {
        location.reload(true);
      }, 5000);
        }
    })
}
</script>
</body>
</html>
