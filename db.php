<?php
$TRPS["servername"] = "localhost";
$TRPS["username"] = "root";
$TRPS["password"] = null;
$TRPS["dbname"] = "support_database";
$TRPS["salt"] = "My_strong_salt";
$TRPS["document_root"]="/trps/index.php";
$TRPS["default_language"] = "ru";

session_start();
$Mysql = new mysqli($TRPS["servername"],$TRPS["username"],$TRPS["password"],$TRPS["dbname"]);

$USER = new stdClass;
$USER->Autorized = false;
if (isset($_SESSION["token"])) {
    $result = $Mysql->query("SELECT `id`, `login`, `firstname`, `lastname`, `support`, `admin`, `root` FROM `users` WHERE token='" . $_SESSION["token"] . "'");
    if ($result->num_rows != 0) {
        $result = $result->fetch_assoc();
        $USER->ID = intval($result["id"]);
        $USER->login = $result["login"];
        $USER->firstname = $result["firstname"];
        $USER->lastname = $result["lastname"];
        $USER->support = filter_var($result["support"], FILTER_VALIDATE_BOOLEAN);
        $USER->admin =filter_var( $result["admin"], FILTER_VALIDATE_BOOLEAN);
        $USER->root = filter_var($result["root"], FILTER_VALIDATE_BOOLEAN);
        $USER->Autorized = true;
    }
}

if (!$USER->Autorized and $_SERVER["SERVER_NAME"].$_SERVER['PHP_SELF']!=$_SERVER["SERVER_NAME"].$TRPS["document_root"]){
    header( 'Location: '.$TRPS["document_root"]);
}

function convert_datetime($datetime, $format){
    date_default_timezone_set("UTC");
    $newdatetime= new datetime($datetime);
    $newdatetime->setTimezone(new DateTimeZone($_COOKIE["timezone"]));
    return $newdatetime->format($format);
}