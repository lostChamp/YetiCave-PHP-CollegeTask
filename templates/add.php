<main>
    <nav class="nav">
      <ul class="nav__list container">
        <?=$nav?>
      </ul>
    </nav>
    <form class="form form--add-lot container <?=validate_froms_count_errors($errors)?>" action="add.php" method="post" enctype="multipart/form-data">
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <div class="form__item <?=validate_forms_in_errors_array("lot-name", $errors)?>">
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input id="lot-name" type="text" name="lot-name" value="<?=$data["name"]?>" placeholder="Введите наименование лота">
          <span class="form__error">Введите наименование лота</span>
        </div>
        <div class="form__item <?=validate_forms_in_errors_array("category", $errors)?>">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="category">
            <option>Выберите категорию</option>
            <?php
            foreach($categories as $value):
            ?>
                <option <?=$value["name"] === $data["category"] ? "selected" : "" ?>><?=htmlspecialchars($value["name"])?></option>
            <?php endforeach;?>
          </select>
          <span class="form__error">Выберите категорию</span>
        </div>
      </div>
      <div class="form__item form__item--wide <?=validate_forms_in_errors_array("message", $errors)?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" value="<?=$data["message"]?>" name="message" placeholder="Напишите описание лота"><?=$data["message"]?></textarea>
        <span class="form__error">Напишите описание лота</span>
      </div>
      <div class="form__item form__item--file">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file <?=validate_forms_in_errors_array("image", $errors)?>">
          <input class="visually-hidden" type="file" id="lot-img" value="" name="image">
          <label for="lot-img">
            Добавить
          </label>
          <span class="form__error"><?=$errors_messages["image_format"] === "" ? "Добавьте фото" : $errors_messages["image_format"]?></span>
        </div>
      </div>
      <div class="form__container-three">
        <div class="form__item form__item--small <?=validate_forms_in_errors_array("lot-rate", $errors)?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input value="<?=$data["rate"]?>" id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?=$data["rate"]?>">
          <span class="form__error"><?=$errors_messages["lot_rate"] === "" ? "Введите начальную цену" : $errors_messages["lot_rate"]?></span>
        </div>
        <div class="form__item form__item--small <?=validate_forms_in_errors_array("lot-step", $errors)?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input value="<?=$data["step"]?>" id="lot-step" type="text" name="lot-step" placeholder="0" value="<?=$data["step"]?>">
          <span class="form__error"><?=$errors_messages["lot_step"] === "" ? "Введите шаг" : $errors_messages["lot_step"]?></span>
        </div>
        <div class="form__item <?=validate_forms_in_errors_array("lot-date", $errors)?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input value="<?=$data["date"]?>" class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?=$data["date"]?>">
          <span class="form__error"><?=$errors_messages["lot_date"] === "" ? "Дату завершения торгов" : $errors_messages["lot_date"]?></span>
        </div>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Добавить лот</button>
    </form>
  </main>


