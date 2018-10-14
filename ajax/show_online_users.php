<?php


$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Message.php');
$msg = new Message();
?>

<?php
if (isset($_GET['value'])) {

 $onlineUsers = $msg->getTotalNumbersOnline();

 if ($onlineUsers !== false) {
 	echo $onlineUsers;
 } else {
 	echo 0;
 }


}

?>
