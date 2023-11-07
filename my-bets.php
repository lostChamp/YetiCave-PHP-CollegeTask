<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");

$nav = include_template("nav.php", [
  "categories" => get_categories($con)
]);

$bets = get_bets_by_user_id($con, $_SESSION["user"]);
$bets_id_for_my_bets = [];

foreach ($bets as $bet) { 
  if($bet["winner"] === $_SESSION["user"]) {
    array_push($bets_id_for_my_bets, $bet["id"]);
  }
}

$my_bets = include_template("my-bets.php", [
  "nav" => $nav,
  "bets" => $bets,
  "bets_id_for_my_bets" => $bets_id_for_my_bets,
]);

$layout = include_template("layout.php", [
  "main" => $my_bets,
  "is_auth" => $is_auth,
  "user_name" => $_SESSION["name"] ?? "",
  "title" => "YetiCave",
  "nav" => $nav,
]);

print($layout);