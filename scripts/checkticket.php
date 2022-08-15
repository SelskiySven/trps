<?php
include("../db.php");
if ($USER->support or $USER->root or $USER->admin){
$id = $_GET["id"];
$result=$Mysql->query("SELECT * FROM `tickets` WHERE id=".$id);
echo $result->num_rows;
} else {
    header( 'Location: '.$TRPS["document_root"]);
}