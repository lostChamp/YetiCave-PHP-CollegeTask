<main>
  <nav class="nav">
      <ul class="nav__list container">
        <?=$nav?>
      </ul>
  </nav>
  <div class="container">
    <section class="lots">
      <?php if($lots):?>
      <h2>Все лоты в категории «<span><?=$category?></span>»
      <ul class="lots__list">
        <?php foreach($lots as $lot):?>
        <li class="lots__item lot">
        <div class="lot__image">
              <img src=<?=htmlspecialchars($lot["image"])?> width="350" height="260" alt="">
          </div>
          <div class="lot__info">
              <span class="lot__category"><?=htmlspecialchars($lot["category"])?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$lot["id"]?>"><?=$lot["name"]?></a></h3>
              <div class="lot__state">
                  <div class="lot__rate">
                      <span class="lot__amount">Стартовая цена</span>
                      <span class="lot__cost"><?=htmlspecialchars(add_rubles($lot["start_price"]))?></span>
                  </div>
                  <div class="lot__timer timer <?=(intval(create_time($lot["end_date"])[0]) < 24) ? "timer--finishing" : " " ?>">
                      <?php
                      $date = create_time($lot["end_date"]);
                      ?>
                      <?=$date[0] . ":" . $date[1]?>
                  </div>
              </div>
          </div>
        </li>
        <?php endforeach;?>
      </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a href="all-lots.php?category=<?=$category?>&page=<?=$curr_page - 1?>">Назад</a></li>
        <?php
        for($i = 1; $i <= $count_pag; $i++):?>
        <li class="pagination-item <?=intval($curr_page) === $i ? "pagination-item-active" : ""?>"><a href="all-lots.php?category=<?=$category?>&page=<?=$i?>"><?=$i?></a></li>
        <?php endfor;?>
        <li class="pagination-item pagination-item-next"><a href="all-lots.php?category=<?=$category?>&page=<?=$curr_page + 1?>">Вперед</a></li>
    </ul>
    <?php else: ?>
          <h2>Результаты поиска по запросу «<span><?=$category?></span>»</h2>
          <h3>По данной категории нет лотов</h2>
    <?php endif; ?>
  </div>
</main>
</main>