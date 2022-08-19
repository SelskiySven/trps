<?php
include("../db.php");
if (!($USER->admin or $USER->root)){
    header( 'Location: '.$TRPS["document_root"]);
}
if ($USER->root){
    $support = $_GET["support"];
    $admin = $_GET["admin"];
    $root = $_GET["root"];
    $id = $_GET["id"];
    $sql = "UPDATE `Users` SET `support`=b'".$support."', `admin`=b'".$admin."', `root`=b'".$root."' WHERE `id`=".$id;
} else {
    $support = $_GET["support"];
    $id = $_GET["id"];
    $sql = "UPDATE `Users` SET `support`=b'".$support."' WHERE `id`=".$id;
}
$Mysql->query($sql);
exit;
?>