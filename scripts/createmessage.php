<?php
include("../db.php");
$userid=$USER->ID;
$ticketid = $_GET["ticket"];
$message = $_GET["message"];
$date = gmdate("Y-m-d H:i:s");

$result=$Mysql->query("SELECT `created_by` FROM `tickets` WHERE `id`=".$ticketid);
$row = $result->fetch_assoc();
if (!($USER->support or $USER->admin or $USER->root) and $userid!=$row["created_by"]){
    header( 'Location: '.$TRPS["document_root"]);
} else{
    $Mysql->query("INSERT INTO `messages`(`id`, `user`, `ticket_id`, `datetime`, `message`) VALUES (NULL,".$userid.",".$ticketid.",'".$date."',".$message.")");
}
exit;
?>