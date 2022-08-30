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
$nameclass = "";
$dateclass = "";
$sortedclass = "";
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
    $dateclass = "sort_arrow";
} else {
    $nameclass = "sort_arrow";
}
if ($sorttype == "DESC") {
    $sortedclass = " resort";
}
$result = $Mysql->query("SELECT COUNT(id) as `count` FROM `users`");
$row = $result->fetch_assoc();
$count_users = $row["count"];
?>

<body>
    <div class="centred">
        <div>
            <div class="controls">
                <span><input type="text" id="search_user" class="input_styled" value=<?php echo "'" . $search . "'" ?>><button class="button_styled" onclick="search_by_name()"><?php echo $TRPS["lang"]["search"]; ?></button></span>
                <span class="sort" onclick="update_limit(25)">25</span>
                <span class="sort" onclick="update_limit(50)">50</span>
                <span class="sort" onclick="update_limit(100)">100</span>
            </div>
            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <div class=<?php echo "'sort " . $nameclass . $sortedclass . "'" ?> onclick="change_sort('name')"><?php echo $TRPS["lang"]["first_name"]; ?></div>
                        </th>
                        <th>
                            <div class=<?php echo "'sort " . $dateclass . $sortedclass . "'" ?> onclick="change_sort('reg')"><?php echo $TRPS["lang"]["registration_date"]; ?></div>
                        </th>
                        <th><?php echo $TRPS["lang"]["support"]; ?></th>
                        <th><?php echo $TRPS["lang"]["admin"]; ?></th>
                        <th><?php echo $TRPS["lang"]["root"]; ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
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
                        echo "<tr><td>" . $row["lastname"] . " " . $row["firstname"] . "</td><td>" . $date . "</td><td><input class='checkbox_styled' id='support_checkbox_" . $row["id"] . "' onchange = 'show_button(" . $row["id"] . ")' type='checkbox' " . $support_checked . "></td><td><input class='checkbox_styled' id='admin_checkbox_" . $row["id"] . "' onchange = 'show_button(" . $row["id"] . ")' type='checkbox' " . $admin_checked . " " . $root_disabled . "></td><td><input class='checkbox_styled' id='root_checkbox_" . $row["id"] . "' onchange = 'show_button(" . $row["id"] . ")' type='checkbox' " . $root_checked . " " . $root_disabled . "></td><td><button id='save_button_" . $row["id"] . "' class='hidden button_styled' onclick='change_role(" . $row["id"] . ")'>" . $TRPS["lang"]["save"] . "</button></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="button_styled" onclick="page_minus()" id="prev_page">&lt;</button>
            <?php echo $TRPS["lang"]["page"] . ":"; ?>
            <input class="input_styled small" type="text" value=<?php echo "'" . $page . "'"; ?> id="input_page">
            <?php echo $TRPS["lang"]["of"] . " " . (ceil($count_users / $limit)); ?>
            <button class="button_styled" onclick="page_plus()" id="next_page">&gt;</button>
            <button class="button_styled" onclick="go_to_page()"><?php echo $TRPS["lang"]["go"]; ?></button>
        </div>
    </div>
</body>
<script>
    let page = <?php echo $page; ?>;
    let limit = <?php echo $limit; ?>;
    let maxpage = <?php echo (ceil($count_users / $limit)); ?>;
    let sort = <?php echo "'" . $sort . "'"; ?>;
    let sorttype = <?php echo "'" . $sorttype . "'"; ?>;
    let search = <?php echo "'" . $search . "'"; ?>;
</script>
<script src="rolesettings_script.js"></script>