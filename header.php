<?php

include("db.php");
if (!isset($_COOKIE["UI_LANG"])){
setcookie("UI_LANG", $TRPS["default_language"], 0, substr($TRPS["document_root"],0,strrpos($TRPS["document_root"],"/")));
header("Refresh:0");
}
include("lang/".$_COOKIE["UI_LANG"]."/lang.php");

if (!$USER->Autorized and $_SERVER["SERVER_NAME"].$_SERVER['PHP_SELF']!=$_SERVER["SERVER_NAME"].$TRPS["document_root"]){
    header( 'Location: '.$TRPS["document_root"]);
}
?>
<script>
    let select_is_open = false
    function openselect(elem) {
        if (!elem.parentElement.classList.contains("select_open")) {
            elem.parentElement.classList.add("select_open")
            elem.nextSibling.nextSibling.classList.add("options_open")
            setTimeout(() => {
                select_is_open = true
            }, 100);
        }
    }

    function closeselect() {
        if (select_is_open) {
            for (i of document.getElementsByClassName("select")) {
                i.classList.remove("select_open")
                i.children[1].classList.remove("options_open")
            }
            select_is_open = false
        }
    }

    document.addEventListener("click", closeselect)
</script>