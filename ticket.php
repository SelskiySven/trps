<?php include("header.php");
include("frames/head.php");
?>

<body>
    <?php include("frames/mainmenu.php") ?>
    <h1><?php echo $TRPS["lang"]["id_of_problem"] . $_GET["id"]; ?></h1>
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
    <h2><?php echo $TRPS["lang"]["title_of_problem"].": ".$row["title"]; ?></h2>
    <h3><?php echo $TRPS["lang"]["problem"].": ".$row["problem"]; ?></h3>
</body>