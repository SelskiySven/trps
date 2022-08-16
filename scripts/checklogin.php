<?php
include("../db.php");
$login = $_GET["login"];
$result=$Mysql->query("SELECT `login` FROM users WHERE login='".$login."'");
echo ($result->num_rows);