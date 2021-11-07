<?php include "db.php"; ?>
<?php if(isset($_GET['username'])){
    $username = $_GET['username'];
} 
else{
    redirect("index.php");
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
<body class="overflow-hidden">
<div class="col-4 d-none d-md-block float-end">
        <div class="display-6 text-center">Conversation started </div>    
        <div class="h6 lead text-center mt-3">You and <?php echo $username; ?></div>
        </div>
 <div class='loaded_messages' id='scroll_messages'>
</div>

        <div class="fixed-bottom col-sm-12 col-md-8 mt-3">
            <div class="" id="chats">
<form class="d-flex form" action="" method="post" onsubmit="prevent(event)" id="okay">
                <div class="col-11">
                    <div class="mb-3">
                        <label for="" class="form-label"></label>
                        <input type="text" name="body" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <input type="text" hidden id="" name="user_to" value="<?php echo $username ?>" class="form-control" aria-describedby="">
                    </div>
                </div>
                <div class="col-auto">
     <button type="submit" class="btn btn-success mt-4">
        <i class="fas fa-paper-plane"></i>
    </button>
                </div>
            </form>
            </div>
        </div>
   
    <!-- Call this script after bootstrap.bundle.min.js CDN -->
    <script>
        function showToast() {
            var toastDOMElement = document.getElementById("liveToast");
            var myToast = new bootstrap.Toast(toastDOMElement);
            myToast.show();
        }
    </script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<style src = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);

      function prevent(event){
       event.preventDefault();
       var formData = new FormData($("#okay")[0]);
    //    var form =$('.form').serialize();
       $.ajax({
        url: "message_ajax.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response){
            // $('.real').html(response);
            console.log(response)

        }
    })
      }
      setInterval(()=>{
        var user = '<?php echo $username; ?>';
        $.ajax({
        url: "get_message_ajax.php",
        type: "POST",
        data: {data: user},
        cache: false,
        success: function(response){
            $('.loaded_messages').html(response);   
            var div = document.getElementById("scroll_messages");
div.scrollTop = div.scrollHeight;
        }
    })
      },300)
</script>
<style>



/* .chat p {
  background: blue;
  padding: 16px 20px;
  margin: 0;
} */


.message {
	border: 1px solid #000;
	border-radius: 5px;
	padding: 5px 10px;
	display: inline-block;
	color: #fff;
}

.message#blue {
	background-color: #3498db;
	border-color: #2980b9;
	float: right;
	margin-bottom: 5px;
}
.message#green {
	background-color: #2ecc71;
	border-color: #27ae60;
	float: left;
	margin-bottom: 5px;
}

.loaded_messages {
	height: 70%;
  width: 64%;
	min-height: 520px;
	max-height: 700px;
	overflow: scroll !important;
	margin-bottom: 25px;
}
/* .disp{
  display: flex;
  overflow: auto;
} */
</style>
</body>
</html>
