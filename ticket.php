<?php include("header.php");
include("frames/head.php");
?>

<body>
    <?php include("frames/mainmenu.php") ?>
    <?php
    $result = $Mysql->query("SELECT `title`,`problem`,`created_by`, `worked_by`, `solved` FROM `tickets` WHERE id=" . $_GET["id"]);
    if ($result->num_rows == 0) {
        header('Location: ' . $TRPS["document_root"]);
        exit;
    }
    $row = $result->fetch_assoc();
    if (!($USER->support or $USER->root or $USER->admin) and $USER->ID != $row["created_by"]) {
        header('Location: ' . $TRPS["document_root"]);
        exit;
    }
    ?>
    <div class="problem_info">
    <h3 id="ticket_id" ticket_id=<?php echo "'" . $_GET["id"] . "'"; ?>><?php echo $TRPS["lang"]["id_of_problem"] . $_GET["id"]; ?></h3>
    <?php if ($row["solved"] == 0 and $row["worked_by"] == 0) : ?>
        <h3><?php echo $TRPS["lang"]["status"] . ": " . $TRPS["lang"]["open"]; ?></h3>
    <?php endif; ?>
    <?php if ($row["solved"] == 1) : ?>
        <h3><?php echo $TRPS["lang"]["status"] . ": " . $TRPS["lang"]["close"]; ?></h3>
    <?php endif; ?>
    <?php
    if ($row["solved"] == 0 and $row["worked_by"] != 0){
        $result = $Mysql->query("SELECT `firstname`,`lastname` FROM `users` WHERE `id` = ".$row["worked_by"]);
        $userdata = $result->fetch_assoc();
        echo "<h3>".$TRPS["lang"]["status"] . ": " . $TRPS["lang"]["in_work"]." ".$userdata["firstname"]." ".$userdata["lastname"]."</h3>";
    }
    ?>
    <?php if ($row["solved"] == 0 and $row["worked_by"] == 0 and ($USER->support or $USER->admin or $USER->root)) : ?>
        <button id="take_ticket" onclick="takeTicket()" class="button_styled" error=<?php echo "'" . $TRPS["lang"]["someone_support_this_ticket"] . "'"; ?>><?php echo $TRPS["lang"]["take"]; ?></button>
    <?php endif; ?>
    <?php if (!($USER->support or $USER->admin or $USER->root) and $row["solved"] == 0) : ?>
        <button onclick="closeTicket()" class="button_styled"><?php echo $TRPS["lang"]["problem_solved"]; ?></button>
    <?php endif; ?>
    </div>
    <div class="centred" id="messager">
        <div>
        <?php if ($row["created_by"] == $USER->ID) : ?>
        <span class="my_problem_wrap">
            <div><?php echo $row["title"]; ?></div>
            <div><?php echo $row["problem"]; ?></div>
        </span>
        <?php else: ?>
            <span class="not_my_problem_wrap">
            <div><?php echo $row["title"]; ?></div>
            <div><?php echo $row["problem"]; ?></div>
        </span>
        <?php endif; ?>
        <div id="for_messages"></div>
        </div>
    </div>
    <div class="centred">
        <textarea name="" id="new_message"></textarea>
        <button onclick="send_message()"><?php echo $TRPS["lang"]["send"]; ?></button>
    </div>
</body>
<script src="ticket_script.js"></script>