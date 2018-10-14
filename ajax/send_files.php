
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Message.php');
$msg = new Message();

 ?>

<?php

if (isset($_FILES['send_file']['name'])) {
  $file_name = $_FILES['send_file']['name'];
  $tmp_name = $_FILES['send_file']['tmp_name'];

  $sendFile = $msg->sendFile($file_name , $tmp_name);

  if ($sendFile == false ) {
     echo "error";
  }
  if ($sendFile == true ) {
     echo "success";
  }



}

 ?>


