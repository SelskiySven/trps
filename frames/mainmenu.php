<nav class="mainnav">
    <?php if (!($USER->support or $USER->root or $USER->admin)) : ?>
        <a href="index.php"><?php echo $TRPS["lang"]["new_ticket"]; ?></a>
    <?php else : ?>
        <a href="index.php"><?php echo $TRPS["lang"]["tickets"]; ?></a>
    <?php endif; ?>
    <a href="mytickets.php"><?php echo $TRPS["lang"]["my_tickets"]; ?></a>
    <?php if ($USER->root or $USER->admin) : ?>
        <a href="rolesettings.php"><?php echo $TRPS["lang"]["role_settings"]; ?></a>
    <?php endif; ?>
    <span class="rightmainmenu">
        <?php
        include("selectlanguage.php");
        ?>
        <span id="user_menu_wrap">
            <span id="user_profile" onclick="force_open()"><?php echo $USER->firstname . " " . $USER->lastname; ?></span>
            <span id="user_menu">
                <a href=""><?php echo $TRPS["lang"]["notifications"]; ?></a>
                <a href="scripts/exit.php"><?php echo $TRPS["lang"]["exit"]; ?></a>
            </span>
        </span>
    </span>
</nav>
<script>
    let menu_is_closed = true

    function force_open() {
        if (document.getElementById("user_menu").style.display != "block" | menu_is_closed) {
            document.getElementById("user_menu").style.display = "block"
            setTimeout(() => {
                menu_is_closed = false
            }, 100);
        } else {
            document.getElementById("user_menu").style.display = ""
            menu_is_closed = true
        }
    }
    document.addEventListener("click", force_open)
</script>