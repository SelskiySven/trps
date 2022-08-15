<nav>
<?php if (!($USER->support or $USER->root or $USER->admin)) : ?>
    <a href="index.php"><?php echo $TRPS["lang"]["new_ticket"]; ?></a> |
<?php else : ?>
    <a href="index.php"><?php echo $TRPS["lang"]["tickets"]; ?></a> |
<?php endif; ?>
<a href="mytickets.php"><?php echo $TRPS["lang"]["my_tickets"]; ?></a> |
<?php if ($USER->root or $USER->admin) : ?>
    <a href="rolesettings.php"><?php echo $TRPS["lang"]["role_settings"]; ?></a> |
<?php endif; ?>
<select name="UI_LANG" id="change_language" onchange="change_language()">
    <?php
    $dirs = scandir("lang");
    foreach ($dirs as $lang) {
        if ($lang != "." and $lang != "..") {
            if ($_COOKIE["UI_LANG"] == $lang) {
                echo '<option value="' . $lang . '" selected>' . $lang . '</option>';
            } else {
                echo '<option value="' . $lang . '">' . $lang . '</option>';
            }
        }
    }
    ?>
</select> |
<?php
echo "<a>".$USER->firstname . " " . $USER->lastname."</a>";
?> |
<a href="scripts/exit.php"><?php echo $TRPS["lang"]["exit"]; ?></a>
</nav>
<script>
function change_language(){
    let changelanguage = new XMLHttpRequest()
    changelanguage.open("GET","scripts/changelanguage.php?ui="+document.getElementById("change_language").value)
    changelanguage.onload = function(){
        document.location = document.location
    }
    changelanguage.send()
    
}
</script>