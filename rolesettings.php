<?php
include("header.php");
include("frames/head.php");
include("frames/mainmenu.php");

if (!($USER->admin or $USER->root)) {
    header('Location: ' . $TRPS["document_root"]);
}
$page = 1;
$limit = 25;
$sort = "name";
$sorttype = "ASC";
$search = "";
$order = "CONCAT(`lastname`,' ',`firstname`)";
if (isset($_GET["page"])) {
    $page = intval($_GET["page"]);
}
if (isset($_GET["limit"])) {
    $limit = intval($_GET["limit"]);
}
if (isset($_GET["sort"])) {
    $sort = $_GET["sort"];
}
if (isset($_GET["sorttype"])) {
    $sorttype = $_GET["sorttype"];
}
if (isset($_GET["search"])) {
    $search = $_GET["search"];
}
if ($sort == "reg") {
    $order = "registration_date";
}
$result = $Mysql->query("SELECT COUNT(id) as `count` FROM `users`");
$row = $result->fetch_assoc();
$count_users = $row["count"];
?>

<body>
    <input type="text" id="search_user" value=<?php echo "'".$search."'" ?>><button onclick="search_by_name()"><?php echo $TRPS["lang"]["search"]; ?></button>
    <div onclick="update_limit(25)">25</div>
    <div onclick="update_limit(50)">50</div>
    <div onclick="update_limit(100)">100</div>
    <table>
        <tr>
            <td onclick="change_sort('name')"><?php echo $TRPS["lang"]["first_name"]; ?></td>
            <td onclick="change_sort('reg')"><?php echo $TRPS["lang"]["registration_date"]; ?></td>
            <td><?php echo $TRPS["lang"]["support"]; ?></td>
            <td><?php echo $TRPS["lang"]["admin"]; ?></td>
            <td><?php echo $TRPS["lang"]["root"]; ?></td>
            <td></td>
        </tr>
        <?php
        $root_disabled = "disabled";
        if ($USER->root) {
            $root_disabled = "";
        }
        $result = $Mysql->query("SELECT `id`, `firstname`, `lastname`, `registration_date`, `support`, `admin`, `root` FROM `users` WHERE CONCAT(`lastname`,' ',`firstname`) LIKE '%" . $search . "%' ORDER BY " . $order . " " . $sorttype . " LIMIT " . ($page - 1) * $limit . ", " . $limit);
        while ($row = $result->fetch_assoc()) {
            $date = convert_datetime($row["registration_date"], "d.m.Y");
            $support_checked = "";
            $admin_checked = "";
            $root_checked = "";
            if ($row["support"] == "1") {
                $support_checked = "checked";
            }
            if ($row["admin"] == "1") {
                $admin_checked = "checked";
            }
            if ($row["root"] == "1") {
                $root_checked = "checked";
            }
            echo "<tr><td>" . $row["lastname"] . " " . $row["firstname"] . "</td><td>" . $date . "</td><td><input id='support_checkbox_".$row["id"]."' onchange = 'show_button(".$row["id"].")' type='checkbox' " . $support_checked . "></td><td><input id='admin_checkbox_".$row["id"]."' onchange = 'show_button(".$row["id"].")' type='checkbox' " . $admin_checked . " " . $root_disabled . "></td><td><input id='root_checkbox_".$row["id"]."' onchange = 'show_button(".$row["id"].")' type='checkbox' " . $root_checked . " " . $root_disabled . "></td><td><button id='save_button_".$row["id"]."' hidden onclick='change_role(".$row["id"].")'>".$TRPS["lang"]["save"]."</button></td></tr>";
        }
        ?>
    </table>
    <button onclick="page_minus()" id="prev_page"><</button>
    <?php echo $TRPS["lang"]["page"] . ":"; ?>
    <input type="text" value=<?php echo "'" . $page . "'"; ?> id="input_page">
    <?php echo $TRPS["lang"]["of"]." ".(ceil($count_users/$limit)); ?>
    <button onclick="page_plus()" id="next_page">></button>
    <button  onclick="go_to_page()"><?php echo $TRPS["lang"]["go"]; ?></button>
</body>
<script>
    let page = <?php echo $page; ?>;
    let limit = <?php echo $limit; ?>;
    let maxpage = <?php echo (ceil($count_users/$limit)); ?>;
    let sort = <?php echo "'".$sort."'"; ?>;
    let sorttype = <?php echo "'".$sorttype."'"; ?>;
    let search = <?php echo "'".$search."'"; ?>;
</script>
<script src="rolesettings_script.js"></script>