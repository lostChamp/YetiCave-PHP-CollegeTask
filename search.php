<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");

$nav = include_template("nav.php", [
  "categories" => get_categories($con)
]);


if(!empty($_GET)) {
  $search_text = trim($_GET['search']);
  $lots_count = count_lots_by_text($con, $search_text);
  $pagination = pagination_variables($lots_count);
  if($search_text !== "") {
    $lots = find_lots_by_text($con, $search_text, $pagination["offset"], $pagination["limit"]);
  }else {
    header("Location: http://mhsrdrg-m3.wsr.ru");
    die();
  }
}

$search = include_template("search.php", [
  "nav" => $nav,
  "promo" => $lots,
  "search_text" => $search_text ?? "",
  'count_pag' => $pagination["pag_pages"],
  'curr_page' => $pagination["curr_page"],
]);

$layout = include_template("layout.php", [
  "main" => $search,
  "is_auth" => $is_auth,
  "user_name" => $_SESSION["name"] ?? "",
  "title" => "YetiCave",
  "nav" => $nav,
  "search_text" => $search_text
]);

print($layout);