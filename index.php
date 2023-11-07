<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");
require_once("winner.php");

$main = include_template("main.php", [
   "categories" => get_categories($con),
   "promo" => get_lots($con)
]);

$nav = include_template("nav.php", [
   "categories" => get_categories($con)
]);

winners($con);

$layout = include_template("layout.php", [
   "main" => $main,
    "is_auth" => $is_auth,
    "user_name" => $_SESSION["name"] ?? "",
    "title" => "YetiCave",
    "categories" => get_categories($con),
    "nav" => $nav,
]);

print($layout);