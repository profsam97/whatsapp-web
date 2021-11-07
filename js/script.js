$('#status').hide();
$('.status').click(function(){
  $(".mes").addClass("acts");
  $(".rea").removeClass("acts");
  $('#status').show();
  $('.links').hide();
  $('#chats').hide();
  $.ajax({
    url: "./notify.php",
    type: "POST",
    cache: false,
    success: function(response){
        $('.real').html(response);
        console.log(response)
//   setTimeout(function () {
//     location.reload(true);
//   }, 5000);
    }
})
});
$('.chats').click(function(){
  $(".rea").addClass("acts");
  $('#chats').show();
  $('#status').hide();
  $('.links').hide();
  $(".mes").removeClass("acts");

});
