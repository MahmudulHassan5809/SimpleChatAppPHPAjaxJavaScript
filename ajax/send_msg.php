
<?php

  $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Message.php');
	$msg = new Message();

 ?>

<?php

  if (isset($_POST['send_msg'])) {


      $data = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      $send_msg = $data['send_msg'];

      $result = $msg->sendMsg($send_msg);

      if ($result == true) {
         echo json_encode(['status' => 'success']);
      }


  }

 ?>


