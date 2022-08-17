<?php include("../db.php");
if ($USER->support or $USER->root or $USER->admin) {
    $userid = $USER->ID;
    $ticket = $_GET["ticket"];
    $result = $Mysql->query("SELECT `worked_by`, `solved` FROM `tickets` WHERE `id`=" . $ticket);
    $row = $result->fetch_assoc();
    if ($row["worked_by"] == 0 and $row["solved"] == 0) {
        $Mysql->query("UPDATE `tickets` SET `worked_by`=".$userid. " WHERE `id`=".$ticket);
        echo "success";
    } else {
        echo "error";
    }
}
exit;