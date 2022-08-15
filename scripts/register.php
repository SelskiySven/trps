<?php
include("../db.php");

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$login = $_POST["login"];
$password = $_POST["password"];

if (strlen($first_name)!="" and strlen($last_name)!="" and strlen($login)>3 and strlen($login)<256 and strlen($password)>7 and strlen($password)<255){
    $newpassword = md5($password.$TRPS["salt"]);
    $date = date("m.d.Y H:i:s");
    $token = md5($login.$date);
    $_SESSION["token"]=$token;
    $Mysql->query("INSERT INTO `users` (`id`, `firstname`, `lastname`, `login`, `password`, `token`, `support`, `admin`, `root`) VALUES (NULL, '".$first_name."', '".$last_name."', '".$login."', '".$newpassword."', '".$token."', b'0', b'0', b'0')");
}

header( 'Location: ../index.php');
exit;