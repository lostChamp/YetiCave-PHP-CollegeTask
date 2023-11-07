<main>
        <nav class="nav">
            <ul class="nav__list container">
                <?=$nav?>
            </ul>
        </nav>
        <section class="lot-item container">
            <h2><?=$info["name"]?></h2>
            <div class="lot-item__content">
                <div class="lot-item__left">
                    <div class="lot-item__image">
                        <img src=<?=$info["image"]?> width="730" height="548" alt="Сноуборд">
                    </div>
                    <p class="lot-item__category">Категория: <span><?=$info["category"]?></span></p>
                    <p class="lot-item__description"><?=$info["description"]?></p>
                </div>
                <div class="lot-item__right">
                <?php if($is_auth && !$self_lot && !$self_last_bet && !$time_lot):?>
                    <div class="lot-item__state">
                        <div class="lot-item__timer <?=(intval(create_time($info["end_date"])[0]) < 24) ? "timer--finishing" : " " ?> timer">
                            <?php
                            $date = create_time($info["end_date"]);
                            ?>
                            <?=$date[0] . ":" . $date[1]?>
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost"><?=$last_bet['self_price'] ?? $last_bet["price_without_bets"]?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span><?=(array_key_exists('self_price', $last_bet)) ? $last_bet["self_price"] + $info["rate_step"] : $last_bet["price_without_bets"]?> р</span>
                            </div>
                        </div>
                        <form class="lot-item__form" action="lot.php?id=<?=$info["id"]?>" method="post" autocomplete="off">
                            <p class="lot-item__form-item form__item  <?=count($errors) === 0 ? "" : "form__item--invalid"?>">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="text" name="cost" placeholder="<?=(array_key_exists('self_price', $last_bet)) ? $last_bet["self_price"] + $info["rate_step"] : $last_bet["price_without_bets"]?>">
                                <?php
                                if((count($errors) !== 0)):?>
                                <span class="form__error"><?=$errors_messages["invalid_cost"] === "" ? "" : $errors_messages["invalid_cost"]?></span>
                                <?php endif;?>
                            </p>
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    </div>
                <?php endif; ?>
                    <div class="history">
                        <h3>История ставок (<span><?=count($bets)?></span>)</h3>
                        <table class="history__list">
                        <?php
                        foreach($bets as $value):
                            ?>
                            <tr class="history__item">
                                <td class="history__name"><?=$value["user"]?></td>
                                <td class="history__price"><?=$value["self_price"]?></td>
                                <td class="history__time"><?=format_date_for_history_rates($value["create_at"])?></td>
                            </tr>
                        <?php endforeach;?>
                            
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
