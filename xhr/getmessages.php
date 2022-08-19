<?php include("../db.php");
$userid = $USER->ID;
$ticket_id = $_GET["id"];
$result=$Mysql->query("SELECT * FROM `tickets` WHERE `id`=".$ticket_id);
$row = $result->fetch_assoc();
if (($USER->support or $USER->admin or $USER->root) or $userid==$row["created_by"]){
    $result=$Mysql->query("SELECT `messages`.`message`, `messages`.`datetime`, `users`.`firstname`, `users`.`lastname` FROM `messages`, `users` WHERE `messages`.`ticket_id`=".$ticket_id." AND `messages`.`user` = `users`.`id`");
    while ($row = $result->fetch_assoc()){
        $newdate = convert_datetime($row["datetime"],"H:i:s d.m.Y");
        echo "<pre>[".$newdate."] ".$row["firstname"]." ".$row["lastname"].": ".$row["message"]."</pre>";
    }
}
exit;