<?php include("header.php");
include("frames/head.php");
?>


<body>
    <?php if ($USER->Autorized) : ?>
        <?php include("frames/mainmenu.php"); ?>
        <?php if (!($USER->support or $USER->root or $USER->admin)) : ?>
            <div class="centred">
                <form action="scripts/createticket.php" method="post">
                    <input type="text" name="title" id="title_problem" placeholder=<?php echo "'" . $TRPS["lang"]["title"] . "'" ?> required><br>
                    <textarea name="problem" id="text_problem" placeholder=<?php echo "'" . $TRPS["lang"]["problem"] . "'" ?> required></textarea><br>
                    <input type="submit" class="formSubmit" value=<?php echo '"' . $TRPS["lang"]["send"] . '"' ?>>
                </form>
            </div>
            <script>
                let cangettickets = false
            </script>
        <?php else : ?>
            <div class="centred">
                <div>
                    <div class="controls">
                        <span><input class="input_styled small" type="text" error_message=<?php echo "'" . $TRPS["lang"]["ticket_do_not_exists"] . "'" ?> id="id_search"><button class="button_styled" onclick="search_for_id()"><?php echo $TRPS["lang"]["search_by_id"] ?></button></span>
                        <span class="sort" onclick="change_limit(10)">10</span>
                        <span class="sort" onclick="change_limit(50)">50</span>
                        <span class="sort" onclick="change_limit(100)">100</span>
                        <span class="sort" onclick="change_limit(0)"><?php echo $TRPS["lang"]["all"] ?></span>
                        <span class="sort hidden" onclick="getTickets(false); this.classList.add('hidden')" id="update_xhr"><?php echo $TRPS["lang"]["update"] ?></span>
                    </div>
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo $TRPS["lang"]["problem"] ?></th>
                                <th class="sort sort_arrow" onclick="change_sort()"><?php echo $TRPS["lang"]["date"] ?></th>
                            </tr>
                        </thead>
                        <tbody id="for_tickets">

                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                let cangettickets = true
            </script>
        <?php endif; ?>
    <?php else : ?>
        <div class="centred centred_full">
            <div>
                <div id="change_language_main_wrap">
                    <?php
                    include("frames/selectlanguage.php")
                    ?>
                </div>
                <div id="loginform">
                    <form action="scripts/login.php" method="post">
                        <div class="inputWrap"><input type="text" name="login" required><span class="formPlaceholder"><?php echo $TRPS["lang"]["login"] ?></span><i></i></div>
                        <div class="inputWrap"><input type="password" name="password" required><span class="formPlaceholder"><?php echo $TRPS["lang"]["password"] ?></span><i></i></div>
                        <div><?php if (isset($_SESSION["incorrect_input"])) {
                                    echo $TRPS["lang"]["incorrect_login_or_password"];
                                    unset($_SESSION["incorrect_input"]);
                                } ?></div>
                        <div class="underForm"><input class="formSubmit" type="submit" value=<?php echo '"' . $TRPS["lang"]["submit_login"] . '"' ?>>
                            <div class="changeForm" onclick="document.getElementById('registrationform').hidden=false; document.getElementById('loginform').hidden=true;"><?php echo $TRPS["lang"]["have_no_account"] ?></div>
                        </div>
                    </form>
                </div>
                <div id="registrationform" hidden>
                    <form action="scripts/register.php" method="post">
                        <div class="inputWrap"><input type="text" name="first_name" id="registration_first_name" oninput="onChangeFirstName()" required><span class="formPlaceholder"><?php echo $TRPS["lang"]["first_name"] ?></span><i></i>
                            <div class="formHint" id="first_name_hint" title=<?php echo "'" . $TRPS["lang"]["enter_first_name"] . "'" ?> hidden></div>
                        </div>
                        <div class="inputWrap"><input type="text" name="last_name" id="registration_last_name" oninput="onChangeLastName()" required><span class="formPlaceholder"><?php echo $TRPS["lang"]["last_name"] ?></span><i></i>
                            <div class="formHint" id="last_name_hint" title=<?php echo "'" . $TRPS["lang"]["enter_last_name"] . "'" ?> hidden></div>
                        </div>
                        <div class="inputWrap"><input type="text" name="login" id="registration_login" onchange="checkLogin()" oninput="onChangeLogin()" required><span class="formPlaceholder"><?php echo $TRPS["lang"]["login"] ?></span><i></i>
                            <div class="formHint" id="login_hint" title=<?php echo "'" . $TRPS["lang"]["incorrect_login_length"] . "'" ?> hidden></div>
                            <div class="formHint" id="login_exists" title=<?php echo "'" . $TRPS["lang"]["login_exists"] . "'" ?> hidden></div>
                        </div>
                        <div class="inputWrap"><input type="password" name="password" id="registration_password" oninput="onChangePassword(); onChangePasswordRepeat()" required><span class="formPlaceholder"><?php echo $TRPS["lang"]["password"] ?></span><i></i>
                            <div class="formHint" id="password_hint" title=<?php echo "'" . $TRPS["lang"]["incorrect_password_length"] . "'" ?> hidden></div>
                        </div>
                        <div class="inputWrap"><input type="password" name="repeat_password" id="registration_password_repeat" oninput="onChangePasswordRepeat()" required><span class="formPlaceholder"><?php echo $TRPS["lang"]["repeat_password"] ?></span><i></i>
                            <div class="formHint" id="repeat_password_hint" title=<?php echo "'" . $TRPS["lang"]["passwords_dont_same"] . "'" ?> hidden></div>
                        </div>
                        <div class="underForm"><input class="formSubmit" type="submit" id="registration_submit" value=<?php echo '"' . $TRPS["lang"]["submit_register"] . '"' ?>>
                            <div class="changeForm" onclick="document.getElementById('registrationform').hidden=true; document.getElementById('loginform').hidden=false;"><?php echo $TRPS["lang"]["already_have_account"] ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            let cangettickets = false
        </script>
    <?php endif; ?>
</body>
<script src="index_script.js"></script>

</html>