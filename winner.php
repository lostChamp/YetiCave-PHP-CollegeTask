<?php

require_once("helpers.php");
require_once("init.php");
require_once("functions.php");
require_once("functions-help.php");

function winners(mysqli $con): void
{
  $lots_id_ended = get_lots_id_where_date_end($con);

  if (count($lots_id_ended) !== 0) {
    foreach ($lots_id_ended as $field) {
      $bet_id = get_bets_for_lot_by_id($con, $field["id"])[0] ?? null;
      if (!is_null($bet_id)) {
        $winner_id = $bet_id["id"];
        set_winner_for_lot($con, $field["id"], $winner_id);
      }
    }
  }
}

