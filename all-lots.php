<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");

$nav = include_template("nav.php", [
  "categories" => get_categories($con)
]);

if(!empty($_GET)) {
  $category = trim($_GET['category']);
  $category_id = get_category_id_by_name($con, $category)["id"];
  $lots_count = get_count_lots_by_category_id($con, $category_id);
  $pagination = pagination_variables($lots_count);
  $lots = get_lots_by_category_id($con, $category_id, $pagination["limit"], $pagination["offset"]);
}

$all_lots = include_template("all-lots.php", [
  "nav" => $nav,
  "category" => $category,
  "lots" => $lots,
  'count_pag' => $pagination["pag_pages"],
  'curr_page' => $pagination["curr_page"],
]);

$layout = include_template("layout.php", [
  "main" => $all_lots,
  "is_auth" => $is_auth,
  "user_name" => $_SESSION["name"] ?? "",
  "title" => "YetiCave",
  "nav" => $nav,
  "search_text" => $search_text ?? ""
]);

print($layout);