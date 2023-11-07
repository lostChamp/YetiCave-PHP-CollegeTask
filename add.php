<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");

$errors = [];
$errors_messages = [];

if (!empty($_POST)) {
  $required_fields = ["lot-name", "category", "message", "lot-rate", "lot-step", "lot-date"];
  foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
      array_push($errors, $field);
    }
    if ($_POST[$field] === "Выберите категорию") {
      array_push($errors, "category");
    }
  }

  if ($_POST['lot-rate'] < 0) {
    array_push($errors, "lot-rate");
    array_push($errors_messages, "lot_rate_error");
  }

  if ($_POST['lot-step'] < 0 || !filter_var($_POST['lot-step'], FILTER_VALIDATE_INT)) {
    array_push($errors, "lot-step");
    array_push($errors_messages, "lot_step_error");
  }

  if ((strtotime($_POST["lot-date"]) - time()) / 60 / 60 / 24 < 1) {
    array_push($errors, "lot-date");
    array_push($errors_messages, "lot_date_error");
  }

  if (isset($_FILES["image"])) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_name = $_FILES["image"]['tmp_name'];
    if (file_exists($file_name)) {
      $file_type = finfo_file($finfo, $file_name);
      if ($file_type !== 'image/jpeg' && $file_type !== 'image/png') {
        array_push($errors, "image");
        array_push($errors_messages, "error_format");
      } else {
        $file_path = __DIR__ . '/uploads/';
        $full_path_with_image = '/uploads/' . $_FILES['image']['name'];

        move_uploaded_file($_FILES["image"]["tmp_name"], $file_path . $_FILES['image']['name']);
      }

    } else {
      array_push($errors, "image");
    }
  }
}

if (empty($errors) && !empty($_POST)) {
  $category_id = get_category_id_by_name($con, $_POST["category"]);
  $result = add_new_lot($con, $_POST["lot-name"], $_POST["message"], $full_path_with_image, $_POST["lot-rate"], $_POST["lot-date"], $_POST["lot-step"], $_SESSION["user"], $category_id["id"]);
  header("Location: http://mhsrdrg-m3.wsr.ru/lot.php?id=$result");
  die();
}


$nav = include_template("nav.php", [
  "categories" => get_categories($con)
]);

if (!$is_auth) {
  http_response_code(403);
  $add = include_template("403.php", [
    "nav" => $nav
  ]);
} else {
  $add = include_template("add.php", [
    "nav" => $nav,
    "categories" => get_categories($con),
    "errors" => $errors,
    "data" => [
      "name" => $_POST["lot-name"] ?? "",
      "category" => $_POST["category"] ?? "",
      "message" => $_POST["message"] ?? "",
      "rate" => $_POST["lot-rate"] ?? "",
      "step" => $_POST["lot-step"] ?? "",
      "date" => $_POST["lot-date"] ?? "",
    ],
    "errors_messages" => [
      "image_format" => in_array("error_format", $errors_messages) ? "Нужен формат jpeg или png" : "",
      "lot_rate" => in_array("lot_rate_error", $errors_messages) ? "Цена не должна быть меньше нуля" : "",
      "lot_step" => in_array("lot_step_error", $errors_messages) ? "Шаг должен быть целым числом и больше нуля" : "",
      "lot_date" => in_array("lot_date_error", $errors_messages) ? "Разница должна быть минимум в один день!" : "",
    ],
  ]);
}


$layout = include_template("layout.php", [
  "main" => $add,
  "is_auth" => $is_auth,
  "user_name" => $_SESSION["name"] ?? "",
  "title" => "YetiCave",
  "nav" => $nav,
]);

print($layout);
