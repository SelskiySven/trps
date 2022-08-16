<?php

include("db.php");
if (!isset($_COOKIE["UI_LANG"])){
setcookie("UI_LANG", $TRPS["default_language"], 0, substr($TRPS["document_root"],0,strrpos($TRPS["document_root"],"/")));
echo "<script>document.location = document.location</script>";
}
include("lang/".$_COOKIE["UI_LANG"]."/lang.php");

if (!$USER->Autorized and $_SERVER["SERVER_NAME"].$_SERVER['PHP_SELF']!=$_SERVER["SERVER_NAME"].$TRPS["document_root"]){
    header( 'Location: '.$TRPS["document_root"]);
}