<?php

require_once("functions.php");
require_once("functions-help.php");

session_start();

$is_auth = isset($_SESSION["user"]);

$user_name = 'Konstantin';

const HOST = 'localhost';

const LOGIN = 'izjxszbd';

const PASSWORD = 'uk2BXP';

const DB_NAME = 'izjxszbd_m3';

$con = mysqli_connect(HOST, LOGIN, PASSWORD, DB_NAME);
mysqli_set_charset($con, "utf8");

if($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}

if($is_auth) {
    $user_id = $_SESSION["user"];
    $info_user = find_user_by_id($con, $user_id);
    $_SESSION["name"] = $info_user["name"];
}

//если поиск пустой то все лоты или не даст