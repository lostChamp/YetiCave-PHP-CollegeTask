
<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php
            foreach($categories as $value):
                ?>
                <li class="promo__item promo__item--<?=$value["symbol_code"]?>">
                    <a class="promo__link" href="all-lots.php?category=<?=$value["name"]?>"><?=htmlspecialchars($value["name"])?></a>
                </li>
            <?php endforeach;?>
            <!--заполните этот список из массива категорий-->

        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php
            foreach($promo as $item):
                ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src=<?=htmlspecialchars($item["image"])?> width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=htmlspecialchars($item["category"])?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$item["id"]?>"><?=$item["name"]?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=htmlspecialchars(add_rubles($item["start_price"]))?></span>
                            </div>
                            <div class="lot__timer timer <?=(intval(create_time($item["end_date"])[0]) < 24) ? "timer--finishing" : " " ?>">
                                <?php
                                $date = create_time($item["end_date"]);
                                ?>
                                <?=$date[0] . ":" . $date[1]?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach;?>
            <!--заполните этот список из массива с товарами-->

        </ul>
    </section>
</main>