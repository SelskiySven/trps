<?php
include("../db.php");
$ticketid = $_GET["ticket"];

$result = $Mysql->query("SELECT `created_by` FROM `tickets` WHERE `id`=".$ticketid);
$row = $result->fetch_assoc();
if ($row["created_by"]==$USER->ID){
    $Mysql->query("UPDATE `tickets` SET `solved`=b'1' WHERE `id`=".$ticketid);
} else{
    header('Location: ' . $TRPS["document_root"]);
}
exit;