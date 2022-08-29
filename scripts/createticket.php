<?php
include("../db.php");
$title = $_POST["title"];
$problem = $_POST["problem"];
$datetime = gmdate('Y-m-d H:i:s');
$problem = str_replace("<","&lt;",$problem);
$problem = str_replace(">","&gt;",$problem);
$id=$USER->ID;
$Mysql->query("INSERT INTO `tickets` (`id`, `title`, `problem`, `datetime`, `created_by`, `worked_by`, `solved`) VALUES (NULL, '".$title."', '".$problem."', '".$datetime."', '".$id."', 0, b'0')");
header( 'Location: ../mytickets.php');
exit;