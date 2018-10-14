<?php
require '../vendor/autoload.php';
use Carbon\Carbon;

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Message.php');
$msg = new Message();
?>

<?php

if (isset($_GET['msg'])) {

   $clean_message_id = $msg->getCleanMsgId();
   $msg_table_id = $msg->getLastMagId();

   $getAllMsg = $msg->getAllMsg($clean_message_id , $msg_table_id);


  if ($getAllMsg !== false) {
  	foreach ($getAllMsg as $info) {
   	 $full_name = ucwords($info->full_name);
   	 $user_image = $info->image;
   	 $user_status = $info->status;

   	 $message = $info->message;
   	 $msg_type = $info->msg_type;
   	 $db_user_id = $info->user_id;
   	 $msg_time = $info->msg_time;
     $dt = Carbon::parse($msg_time);
   	 $dt = $dt->diffForHumans();

   	 if($user_status == 0){
   	 	$user_online_status = "<i class='fas fa-check-circle' style='color : red;'></i>";
   	 }else{
        $user_online_status = "<i class='fas fa-check-circle' style='color : green;'></i>";
   	 }

   	 if ($db_user_id == Session::get('userid')) {
   	 	//right user message
   	 	if($msg_type == 'text'){
           echo '<li class="right clearfix"><span class="chat-img">
                            <img src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;"/>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$dt.'</small>
                                    <strong class="pull-right primary-font">'.$full_name.'</strong>
                                    '.$user_online_status.'
                                </div>
                                <p>
                                  '.$message.'
                                </p>
                            </div>
                        </li>';
   	 	}else if($msg_type == 'jpg' || $msg_type == 'jpeg' || $msg_type == 'png'){
            $img = substr($message, 3);
            $imgTag= '<img src="'.$img.'">';
            echo '<li class="right clearfix"><span class="chat-img">
                            <img src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;"/>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$dt.'</small>
                                    <strong class="pull-right primary-font">'.$full_name.'</strong>
                                    '.$user_online_status.'
                                </div>

                                <p>
                                 '.$imgTag.'
                                </P>
                            </div>
                        </li>';
   	 	}
   	 	else if($msg_type == 'zip'){
            $zip = substr($message, 3);

            echo '<li class="right clearfix"><span class="chat-img">
                            <img src="src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$dt.'</small>
                                    <strong class="pull-right primary-font">'.$full_name.'</strong>
                                    '.$user_online_status.'
                                </div>

                                <p>
                                  <a href="'.$zip.'"><i class="fas fa-arrow-circle-down"></i>'.$zip.'</a>
                                </P>
                            </div>
                        </li>';
   	 	}
   	 	else if($msg_type == 'docx'){
           $doc = substr($message, 3);

            echo '<li class="right clearfix"><span class="chat-img">
                            <img src="src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;"/>

                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$dt.'</small>
                                    <strong class="pull-right primary-font">'.$full_name.'</strong>
                                    '.$user_online_status.'
                                </div>

                                <p>
                                  <a href="'.$doc.'"><i class="fas fa-file-pdf"></i>'.$zip.'</a>
                                </P>
                            </div>
                        </li>';
   	 	}
   	 } else {
   	 	//left user message

   	 	if($msg_type == 'text'){
          echo '<li class="left clearfix"><span class="chat-img pull-left">
                            <img src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;"/>

                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">'.$full_name.'</strong> <small class="pull-right text-muted">'.$user_online_status.'
                                        <span class="glyphicon glyphicon-time"></span>'.$dt.'</small>

                                </div>
                                <p>
                                    '.$message.'
                                </p>
                            </div>
                        </li>';
   	 	}else if($msg_type == 'jpg' || $msg_type == 'jpeg' || $msg_type == 'png'){
            $img = substr($message, 3);
            $imgTag= '<img src="'.$img.'">';
            echo '<li class="right clearfix"><span class="chat-img">
                            <img src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;"/>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$dt.'</small>

                                    <strong class="pull-right primary-font">'.$full_name.'</strong>
                                    '.$user_online_status.'
                                </div>

                                <p>
                                 '.$imgTag.'
                                </P>
                            </div>
                        </li>';
   	 	}
   	 	else if($msg_type == 'zip'){
            $zip = substr($message, 3);

            echo '<li class="right clearfix"><span class="chat-img">
                            <img src="src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$dt.'</small>
                                    <strong class="pull-right primary-font">'.$full_name.'</strong>
                                    '.$user_online_status.'
                                </div>

                                <p>
                                  <a href="'.$zip.'"><i class="fas fa-arrow-circle-down"></i>'.$zip.'</a>
                                </P>
                            </div>
                        </li>';
   	 	}
   	 	else if($msg_type == 'docx'){
            $doc = substr($message, 3);

            echo '<li class="right clearfix"><span class="chat-img">
                            <img src="src="'.$user_image.'" alt="User Avatar" style="height: 40px;width: 40px;"/>

                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class="text-muted "><span class="glyphicon glyphicon-time"></span>'.$dt.'</small>
                                    <strong class="pull-right primary-font">'.$full_name.'</strong>
                                    '.$user_online_status.'
                                </div>

                                <p>
                                  <a href="'.$doc.'"><i class="fas fa-file-pdf"></i>'.$zip.'</a>
                                </P>
                            </div>
                        </li>';
   	 	}
   	 }

   }
  } else {
    echo "Lets Start Conversation To Your Friends";
 }




}

?>
