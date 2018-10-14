$(document).ready(function(){

   $(".chat-form").keypress(function (e) {
   	 if (e.keyCode == 13) {
   	 	var send_msg = $("#send_msg").val();
	   	 if (send_msg.length != "") {
	   	 	$.ajax({
	   	 		type : 'POST',
		   		url  : 'ajax/send_msg.php',
		   		data : {send_msg : send_msg},
                dataType: 'JSON',
		   		success : function(res){
		   			if (res.status == 'success') {
		   				$(".chat-form").trigger("reset");
                     show_messages();
                     $(".chat").animate({scrollTop: $(".chat")[0].scrollHeight},1000);
		   			}
		   		}
	   	 	})
            .fail(function(err){
               console.log(err);

            })

	   	 }
   	 }
   })

//Uploaded Images and Files

   $("#upload-files").change(function(){
      var file_name = $("#upload-files").val();
      if (file_name.length != "") {
      	 $.ajax({
      	 	type : 'POST',
      	 	url : 'ajax/send_files.php',
      	 	data : new FormData($(".chat-form")[0]),
      	 	contentType : false,
      	 	processData : false,
      	 	success : function(feedback){
               if(feedback.trim() == "error"){
                  $(".text-danger").html("Invalid File Format");
               }
               else if(feedback.trim() == "success"){
                  $(".text-danger").html("File Send SuccessFully");
                  show_messages();
                  $(".chat").animate({scrollTop: $(".chat")[0].scrollHeight},1000);
               }
      	 	}
      	 })
      }


   });

   setInterval(function () {
      show_messages();
   },3000);

})


//Show Messages
function show_messages() {
   var msg = true;
   $.ajax({
      type : 'GET',
      url : 'ajax/show_messages.php',
      data : {'msg' : msg},
      success : function (feedback) {
          $(".chat").html(feedback);
      }
   })
}


//Show Online Users
function show_online() {
   var value = true;
   $.ajax({
      type : 'GET',
      url : 'ajax/show_online_users.php',
      data : {'value' : value},
      success : function (feedback) {
          $(".online").html(feedback);
      }
   })
}

show_messages();
show_online();
$(".chat").animate({scrollTop: $(".chat")[0].scrollHeight},1000);
