<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?=$nav?>
        </ul>
    </nav>
    <section class="rates container">
      <h2>Мои ставки</h2>
      <table class="rates__list">
      <?php
      foreach($bets as $value):
          ?>
          <tr class="rates__item <?=set_class_for_bets($value["id"], $value["date"], $bets_id_for_my_bets)?>">
          <td class="rates__info">
            <div class="rates__img">
              <img src="<?=$value["image"]?>" width="54" height="40" alt="Сноуборд">
            </div>
            <div>
              <h3 class="rates__title"><a href="lot.php?id=<?=$value["id"]?>"><?=$value["name"]?></a></h3>
              <?php
                if($value["description"] !== ""):?>
                <p><?=$value["description"]?></p>
              <?php endif;?>
              </div>
          </td>
          <td class="rates__category">
            <?=$value["category"]?>
          </td>
          <?php
            if(in_array($value["id"], $bets_id_for_my_bets)):
          ?>
          <td class="rates__timer">
            <div class="timer timer--win">Ставка выиграла</div>
          </td>
          <?php 
            elseif((intval(create_time($value["date"])[0]) <= 0) && !(in_array($value["id"], $bets_id_for_my_bets))):
          ?>
          <td class="rates__timer">
            <div class="timer timer--end">Торги окончены</div>
          </td>
          <?php else:?>
          <td class="rates__timer">
            <div class="timer <?=(intval(create_time($value["date"])[0]) < 24) ? "timer--finishing" : " " ?>"><?php
                            $date = create_time($value["date"]);
                            ?>
                            <?=$date[0] . ":" . $date[1]?></div>
          </td>
          <?php endif;?>
          <td class="rates__price">
            <?=add_rubles($value["self_price"])?>
          </td>
          <td class="rates__time">
            <?=format_date_for_history_rates($value["create_at"])?>
          </td>
        </tr>
          
      <?php endforeach;?>
      </table>
    </section>
  </main>
