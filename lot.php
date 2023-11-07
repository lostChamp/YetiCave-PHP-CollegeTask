<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");

$errors = [];
$errors_messages_for_template = [];
$user_id = $_SESSION["user"] ?? "";

$nav = include_template("nav.php", [
    "categories" => get_categories($con)
]);

$error_404 = include_template("404.php", [
    "nav" => $nav,
]);

if(!isset($_GET["id"])){
    $layout = include_template("layout.php", [
        "main" => $error_404,
        "is_auth" => $is_auth,
        "user_name" => $user_name,
        "title" => "YetiCave",
        "nav" => $nav,
    ]);
    print($layout);
    return;
}

$lot_info = get_lot_by_id($con, $_GET["id"]);
$bets = get_bets_for_lot_by_id($con, $_GET["id"]);

if(http_response_code() === 404) {
    $layout = include_template("layout.php", [
        "main" => $error_404,
        "is_auth" => $is_auth,
        "user_name" => $user_name,
        "title" => "YetiCave",
        "nav" => $nav,
    ]);
    print($layout);
    return;
}

if(count($bets) <= 0) {
    $without_bets["price_without_bets"] = $lot_info["start_price"];
    $last_bet_user_id = null;
}else {
    $last_bet_user_id = $bets[0]["id"];
}

if(!empty($_POST)) {
    $required_fields = ["cost"];
    $errors = required_errors($required_fields);
    if(!empty($_POST["cost"])) {
        if(filter_var(($_POST["cost"]), FILTER_VALIDATE_INT)) {
            $cost_from_form = $_POST["cost"];
            $curr_top_price = $bets[0]["self_price"] + $lot_info["rate_step"];
            if($cost_from_form < $curr_top_price) {
                array_push($errors, "cost");
                $errors_messages_for_template["cost"] = "Ставка должна быть больше чем предыдущая!";
            }else {
                create_new_rate($con, $_SESSION["user"], $_GET["id"], $_POST['cost']);
                header("Location: http://mhsrdrg-m3.wsr.ru/lot.php?id=" . $_GET["id"]);
                die();
            }
        }else {
            array_push($errors, "cost");
            $errors_messages_for_template["cost"] = "Ставка должны быть целым числом!";
        }
    }
}


$lot = include_template("lot.php", [
    "info" => $lot_info,
    "nav" => $nav,
    "is_auth" => $is_auth,
    "bets" => $bets,
    "last_bet" => $bets[0] ?? $without_bets,
    "errors" => $errors,
    "errors_messages" => [
        "invalid_cost" => $errors_messages_for_template["cost"] ?? "",
    ],
    "self_lot" => $user_id === $lot_info["author_id"],
    "self_last_bet" => $last_bet_user_id === $user_id,
    "time_lot" => intval(create_time($lot_info["end_date"])[0]) < 0,
]);

$layout = include_template("layout.php", [
    "main" => $lot,
    "is_auth" => $is_auth,
    "user_name" => $_SESSION["name"] ?? "",
    "title" => "YetiCave",
    "nav" => $nav,
]);

print($layout);