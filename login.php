<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");

$errors = [];
$errors_messages = [];


if(!empty($_POST)) {
    $required_fields = ["email", "password",];
    $errors = required_errors($required_fields);
    $user = find_user_by_email($con, $_POST["email"])[0] ?? null;
    if(is_null($user)) {
        array_push($errors, "email");
        $errors_messages["email"] = "Данного пользователя не существует!";
    }else {
        if(!password_verify($_POST["password"], $user["password"])) {
            array_push($errors, "password");
            $errors_messages["password"] = "Не верно введен пароль!";
        }
    }
}

if(empty($errors) && !empty($_POST)) {
    session_start();
    $_SESSION["user"] = $user["id"];
    header("Location: http://mhsrdrg-m3.wsr.ru");
    die();
}

$nav = include_template("nav.php", [
    "categories" => get_categories($con)
]);

$login = include_template("login.php", [
    "nav" => $nav,
    "errors" => $errors,
    "data" => [
        "email" => $_POST["email"] ?? "",
        "password" => $_POST["password"] ?? "",
    ],
    "errors_messages" => [
        "invalid_email" => !empty($errors_messages["email"]) ? $errors_messages["email"] : "",
        "invalid_password" => !empty($errors_messages["password"]) ? $errors_messages["password"] : "",
    ]
]);

$layout = include_template("layout.php", [
    "main" => $login,
    "is_auth" => $is_auth,
    "user_name" => $_SESSION["name"] ?? "",
    "title" => "YetiCave",
    "nav" => $nav,
]);

print($layout);