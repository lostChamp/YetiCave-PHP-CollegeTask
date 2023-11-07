<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");

$errors = [];
$errors_messages = [];

if (!empty($_POST)) {
    $required_fields = ["email", "password", "name", "message"];
    $errors = required_errors($required_fields);
    if (!empty($_POST["email"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "email");
            $errors_messages["email"] = "Не верно введен Email";
        }
        $user = find_user_by_email($con, $_POST["email"]);
        if (count($user) !== 0) {
            array_push($errors, "email");
            $errors_messages["email"] = "Данный Email уже используется!";
        }
    }
}

if (empty($errors) && !empty($_POST)) {
    create_new_user($con, $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["name"], $_POST["message"]);
    header("Location: http://mhsrdrg-m3.wsr.ru/login.php");
    die();
}

$nav = include_template("nav.php", [
    "categories" => get_categories($con)
]);

if ($is_auth) {
    http_response_code(403);
    $signup = include_template("403.php", [
        "nav" => $nav
    ]);
} else {
    $signup = include_template("sign-up.php", [
        "nav" => $nav,
        "errors" => $errors,
        "data" => [
            "email" => $_POST["email"] ?? "",
            "password" => $_POST["password"] ?? "",
            "name" => $_POST["name"] ?? "",
            "message" => $_POST["message"] ?? ""
        ],
        "errors_messages" => [
            "invalid_email" => !empty($errors_messages) ? $errors_messages["email"] : "",
        ],
    ]);
}

$layout = include_template("layout.php", [
    "main" => $signup,
    "is_auth" => $is_auth,
    "user_name" => $_SESSION["name"] ?? "",
    "title" => "YetiCave",
    "nav" => $nav,
]);

print($layout);