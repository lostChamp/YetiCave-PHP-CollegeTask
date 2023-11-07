<main>
    <nav class="nav">
      <ul class="nav__list container">
        <?=$nav?>
      </ul>
    </nav>
    <form class="form container <?=validate_froms_count_errors($errors)?>" action="sign-up.php" method="post" autocomplete="off"> <!-- form--invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item <?=validate_forms_in_errors_array("email", $errors)?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" value="<?=$data["email"]?>" placeholder="Введите e-mail">
        <span class="form__error"><?=$errors_messages["invalid_email"] === "" ? "Введите Email" : $errors_messages["invalid_email"]?></span>
      </div>
      <div class="form__item <?=validate_forms_in_errors_array("password", $errors)?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" value="<?=$data["password"]?>" placeholder="Введите пароль">
        <span class="form__error">Введите пароль</span>
      </div>
      <div class="form__item <?=validate_forms_in_errors_array("name", $errors)?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" value="<?=$data["name"]?>" placeholder="Введите имя">
        <span class="form__error">Введите имя</span>
      </div>
      <div class="form__item <?=validate_forms_in_errors_array("message", $errors)?>">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=$data["message"]?></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="#">Уже есть аккаунт</a>
    </form>
  </main>
