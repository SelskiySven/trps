<?php include("../db.php");
$userid = $USER->ID;
$ticket_id = $_GET["id"];
$result=$Mysql->query("SELECT * FROM `tickets` WHERE `id`=".$ticket_id);
$row = $result->fetch_assoc();
if (($USER->support or $USER->admin or $USER->root) or $userid==$row["created_by"]){
    $result=$Mysql->query("SELECT `messages`.`message`, `messages`.`datetime`, `users`.`firstname`, `users`.`lastname`, `users`.`id` FROM `messages`, `users` WHERE `messages`.`ticket_id`=".$ticket_id." AND `messages`.`user` = `users`.`id`");
    while ($row = $result->fetch_assoc()){
        $newdate = convert_datetime($row["datetime"],"H:i d.m.Y");
        $row["message"]=str_replace("\n","<br>", $row["message"]);
        if ($userid==$row["id"]){
            echo "<div class='my_message'>".$row["message"]."\n<div class='message_info'>".$row["firstname"]." ".$row["lastname"]." ".$newdate."</div></div>";
        } else {
            echo "<div class='not_my_message'>".$row["message"]."\n<div class='message_info'>".$row["firstname"]." ".$row["lastname"]." ".$newdate."</div></div>";
        }
    }
}
exit;