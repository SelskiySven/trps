<?php include("header.php");
include("frames/head.php");
?>

<body>
    <?php include("frames/mainmenu.php") ?>
    <h3 id="ticket_id" ticket_id=<?php echo "'".$_GET["id"]."'"; ?>><?php echo $TRPS["lang"]["id_of_problem"] . $_GET["id"]; ?></h3>
    <?php
    $result = $Mysql->query("SELECT * FROM `tickets` WHERE id=" . $_GET["id"]);
    if ($result->num_rows == 0) {
        header('Location: ' . $TRPS["document_root"]);
        exit;
    }
    $row = $result->fetch_assoc();
    if (!($USER->support or $USER->root or $USER->admin) and $USER->ID!=$row["created_by"]){
        header('Location: ' . $TRPS["document_root"]);
        exit;
    }
    ?>
    <h3><?php echo $TRPS["lang"]["title_of_problem"].": ".$row["title"]; ?></h3>
    <h3><?php echo $TRPS["lang"]["problem"].": ".$row["problem"]; ?></h3>
    <div id="for_messages"></div>
    <textarea name="" id="new_message"></textarea>
    <button onclick="send_message()"><?php echo $TRPS["lang"]["send"];?></button>
</body>
<script src="ticket_script.js"></script>