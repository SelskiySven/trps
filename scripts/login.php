<?php
include("../db.php");

$login = $_POST["login"];
$password = $_POST["password"];
$newpassword = md5($password.$TRPS["salt"]);

$result=$Mysql->query("SELECT * FROM `users` WHERE `login`='".$login."' AND `password`='".$newpassword."'");
if ($result->num_rows!=0){
    $date = gmdate("m.d.Y H:i:s");
    $token = md5($login.$date);
    $_SESSION["token"]=$token;
    $Mysql->query("UPDATE `users` SET `token`='".$token."' WHERE `login`='".$login."' AND `password`='".$newpassword."'");
} else{
    $_SESSION["incorrect_input"]=true;
}

header( 'Location: ../index.php');
exit;