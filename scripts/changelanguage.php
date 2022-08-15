<?php
include("../db.php");
setcookie("UI_LANG", $_GET["ui"], 0, substr($TRPS["document_root"],0,strrpos($TRPS["document_root"],"/")));
exit;