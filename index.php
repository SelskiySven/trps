<?php include("header.php");
include("frames/head.php");
?>


<body>
    <?php if ($USER->Autorized) : ?>
        <?php include("frames/mainmenu.php"); ?>
        <?php if (!($USER->support or $USER->root or $USER->admin)) : ?>
            <form action="scripts/createticket.php" method="post">
                <label for="title"><?php echo $TRPS["lang"]["title"] ?></label><br>
                <input type="text" name="title" id=""><br>
                <label for="problem"><?php echo $TRPS["lang"]["problem"] ?></label><br>
                <textarea name="problem" id=""></textarea><br>
                <input type="submit" value=<?php echo '"' . $TRPS["lang"]["send"] . '"' ?>>
            </form>
        <?php else : ?>
            <input type="text" error_message=<?php echo "'".$TRPS["lang"]["ticket_do_not_exists"]."'"?> id="id_search"><button onclick="search_for_id()"><?php echo $TRPS["lang"]["search_by_id"] ?></button>
            <div onclick="change_sort()"><?php echo $TRPS["lang"]["date"] ?></div>
            <div onclick="change_limit(10)">10</div>
            <div onclick="change_limit(50)">50</div>
            <div onclick="change_limit(100)">100</div>
            <div onclick="change_limit(0)"><?php echo $TRPS["lang"]["all"] ?></div>
            <div onclick="getTickets(false); this.hidden=true" id="update_xhr" hidden><?php echo $TRPS["lang"]["update"] ?></div>
            <div id="for_tickets"></div>
        <?php endif; ?>
    <?php else : ?>
        <div id="form">
            <div id="loginform">
                <form action="scripts/login.php" method="post">
                    <label for="login"><?php echo $TRPS["lang"]["login"] ?></label><br>
                    <input type="text" name="login" required><br>
                    <label for="password"><?php echo $TRPS["lang"]["password"] ?></label><br>
                    <input type="password" name="password" required><br>
                    <div><?php if (isset($_SESSION["incorrect_input"])) {
                                echo $TRPS["lang"]["incorrect_login_or_password"];
                                unset($_SESSION["incorrect_input"]);
                            } ?></div>
                    <input type="submit" value=<?php echo '"' . $TRPS["lang"]["submit_login"] . '"' ?>>
                </form>
                <div onclick="document.getElementById('registrationform').hidden=false; document.getElementById('loginform').hidden=true;"><?php echo $TRPS["lang"]["have_no_account"] ?></div>
            </div>
            <div id="registrationform" hidden>
                <form action="scripts/register.php" method="post">
                    <label for="first_name"><?php echo $TRPS["lang"]["first_name"] ?></label><br>
                    <input type="text" name="first_name" id="registration_first_name" oninput="onChangeFirstName()">
                    <div id="first_name_hint" hidden><?php echo $TRPS["lang"]["enter_first_name"] ?></div><br>
                    <label for="last_name"><?php echo $TRPS["lang"]["last_name"] ?></label><br>
                    <input type="text" name="last_name" id="registration_last_name" oninput="onChangeLastName()">
                    <div id="last_name_hint" hidden><?php echo $TRPS["lang"]["enter_last_name"] ?></div><br>
                    <label for="login"><?php echo $TRPS["lang"]["login"] ?></label><br>
                    <input type="text" name="login" id="registration_login" onchange="checkLogin()" oninput="onChangeLogin()">
                    <div id="login_hint" hidden><?php echo $TRPS["lang"]["incorrect_login_length"] ?></div>
                    <div id="login_exists" hidden><?php echo $TRPS["lang"]["login_exists"] ?></div><br>
                    <label for="password"><?php echo $TRPS["lang"]["password"] ?></label><br>
                    <input type="password" name="password" id="registration_password" oninput="onChangePassword(); onChangePasswordRepeat()">
                    <div id="password_hint" hidden><?php echo $TRPS["lang"]["incorrect_password_length"] ?></div><br>
                    <label for="repeat_password"><?php echo $TRPS["lang"]["repeat_password"] ?></label><br>
                    <input type="password" name="repeat_password" id="registration_password_repeat" oninput="onChangePasswordRepeat()">
                    <div id="repeat_password_hint" hidden><?php echo $TRPS["lang"]["passwords_dont_same"] ?></div><br>
                    <input type="submit" id="registration_submit" value=<?php echo '"' . $TRPS["lang"]["submit_register"] . '"' ?>>
                </form>
                <div onclick="document.getElementById('registrationform').hidden=true; document.getElementById('loginform').hidden=false;"><?php echo $TRPS["lang"]["already_have_account"] ?></div>
            </div>
        </div>
    <?php endif; ?>
</body>
<script src="index_script.js"></script>

</html>