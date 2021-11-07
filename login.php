<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
        <div class="real"></div>
        <div class="container mt-5 bg-success">
            <div class="col-lg-10 mx-auto">
                <div class="h4 display-5 text-center text-light "> Whatsapp</div>
                <div class="row flex-row">
                <div class="col-md-5  p-3 m-3 ">
                    <form method="post" class="form" onsubmit="prevent(event)" >
                <div class="form-floating ">
                    <input type="number" class="form-control" id="floatingInputValue" placeholder="name@example.com" name="number">
                    <label for="floatingInputValue">Enter your number</label>
                </div>
                <br>
                <div class="form-floating ">
                    <input type="text" class="form-control" id="floatingInputValue" placeholder="name@example.com" name="username">
                    <label for="floatingInputValue">Enter your name</label>
                </div>
                <br>
                <div class="form-floating ">
                    <input type="password" class="form-control" id="floatingInputValue" placeholder="name@example.com" name="password">
                    <label for="floatingInputValue">Enter your password</label>
                </div>
                <button type="submit"  class="float-start mt-4 w-100 btn btn-outline-dark btn-lg">Register</button>
                </form>
                </div>
          
                <div class="col-md-5  p-3 m-3 ">
                <form method="post" class="forms" onsubmit="prevents(event)" >
                <div class="form-floating ">
                    <input type="text" class="form-control" id="floatingInputValue" placeholder="name@example.com" name="username" required>
                    <label for="floatingInputValue">Enter your name</label>
                </div>
                <br>
                <div class="form-floating ">
                    <input type="password" required class="form-control" id="floatingInputValue" placeholder="name@example.com" name="password">
                    <label for="floatingInputValue">Enter your password</label>
                </div>
                <button type="submit"  class="float-start mt-4 w-100 btn btn-outline-primary btn-lg">Login</button>
                </div>
                </form>
                </div>
            </div>
            </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
          function prevent(event){
       event.preventDefault();
       var form =$('.form').serialize();
       $.ajax({
        url: "register.php",
        type: "POST",
        data: form,
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
function prevents(event){
       event.preventDefault();
       var form =$('.forms').serialize();
       $.ajax({
        url: "logins.php",
        type: "POST",
        data: form,
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