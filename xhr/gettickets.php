<?php
include("../db.php");
?>

<body>
    <table>
        <?php
        $sql = "";
        if (($USER->support or $USER->root or $USER->admin) and $_GET["personal"]=="no") {
            if ($_GET["limit"] == "0") {
                $sql = "SELECT * FROM `tickets` WHERE `worked_by` = 0 and `solved` = 0 ORDER BY `datetime` " . $_GET["sort"];
            } else {
                $sql = "SELECT * FROM `tickets` WHERE `worked_by` = 0 and `solved` = 0 ORDER BY `datetime` " . $_GET["sort"] . " LIMIT " . $_GET["limit"];
            }
        } else {
            if ($USER->support or $USER->root or $USER->admin){
                $sql = "SELECT * FROM `tickets` WHERE `worked_by` = ".$USER->ID." ORDER BY `solved` ASC, `datetime` DESC";
            } else {
                $sql = "SELECT * FROM `tickets` WHERE `created_by` = ".$USER->ID." ORDER BY `solved` ASC, `datetime` DESC";
            }
        }
        $result = $Mysql->query($sql);
            while ($row = $result->fetch_assoc()) {
                $newdate = substr($row["datetime"], 11, 5) . " " . substr($row["datetime"], 8, 2) . "." . substr($row["datetime"], 5, 2) . "." . substr($row["datetime"], 0, 4);
                if ($row["solved"]==0){
                echo "<tr><td><b><a href='ticket.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></b></td><td>" . $newdate . "</td></tr>";
                } else{
                    echo "<tr><td><a href='ticket.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></td><td>" . $newdate . "</td></tr>";
                }
            }
        ?>

    </table>
</body>