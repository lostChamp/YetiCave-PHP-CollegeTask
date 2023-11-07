<?php

function set_class_for_bets(int $id, string $date, array $bets_id_for_my_bets): string {
  if(in_array($id, $bets_id_for_my_bets)) {
    return "rates__item--win";
  } else if((intval(create_time($date)[0]) <= 0) && !(in_array($date, $bets_id_for_my_bets))) {
    return "rates__item--end";
  }else {
    return "";
  }
}

function format_date_for_history_rates(string $date): string {
  date_default_timezone_set("Asia/Yekaterinburg");

  $difference = time() - strtotime($date);
  $day = floor($difference / (3600 * 24));
  $hours = floor($difference / 3600);
  $minutes = floor($difference / 60);
  $seconds = $difference;

  if($day >= 1) { 
      return $day . " " . get_noun_plural_form($day, "день", "дня", "дней") . " назад";
  }

  if($hours >= 1) { 
      return $hours . " " . get_noun_plural_form($hours, "час", "часа", "часов") . " назад";
  }

  if($minutes >= 1) { 
      return $minutes . " " . get_noun_plural_form($hours, "минуту", "минуты", "минут") . " назад";
  }

  return $seconds . " " . get_noun_plural_form($seconds, "секунд", "секунды", "секунд") . " назад";
}

function add_rubles(int $price): string {
  return number_format($price, 0, ".", " ") . " ₽";
}

function create_time(string $expDate): array {
  date_default_timezone_set("Asia/Yekaterinburg");
  $now = time();
  $time = strtotime($expDate);

  $remain = ($time - $now) + (24 * 3600) + 60;

  $hours = str_pad(floor($remain / 3600), 2, "0", STR_PAD_LEFT);
  $minutes = str_pad(floor(($remain / 60) - ($hours * 60)), 2, "0", STR_PAD_LEFT);

  return [$hours, $minutes];
}

function required_errors(array $required_fields): array {
  $errors = [];
  foreach ($required_fields as $field) {
    if(empty($_POST[$field])) {
      array_push($errors, $field);
    }
  }
  return $errors;
}

function pagination_variables(int $lots_count): array {
  $limit = 3;
  $pag_pages = ceil($lots_count / $limit);
  $curr_page = !empty($_GET["page"]) ? $_GET["page"] : 1;
  if($curr_page <= 0) {
    $curr_page = 1;
  }
  if($curr_page >= $pag_pages) {
    $curr_page = $pag_pages;
  }
  $offset = ($curr_page - 1) * $limit;
  return [
    "limit" => $limit,
    "offset" => $offset,
    "curr_page" => $curr_page,
    "pag_pages" => $pag_pages,
  ];
}

function validate_forms_in_errors_array(string $field, array $errors): string {
  return (in_array($field, $errors)) ? "form__item--invalid" : "";
}

function validate_froms_count_errors(array $errors): string {
  return (count($errors) === 0) ? "" : "form--invalid";
}