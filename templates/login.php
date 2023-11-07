
<main>
<nav class="nav">
    <ul class="nav__list container">
    <?=$nav?>
    </ul>
</nav>
<form class="form container <?=validate_froms_count_errors($errors)?>" action="login.php" method="post">
    <h2>Вход</h2>
    <div class="form__item <?=validate_forms_in_errors_array("email", $errors)?>">
    <label for="email">E-mail <sup>*</sup></label>
    <input id="email" type="text" name="email" value="<?=$data["email"]?>" placeholder="Введите e-mail">
    <span class="form__error"><?=$errors_messages["invalid_email"] === "" ? "Введите Email" : $errors_messages["invalid_email"]?></span>
    </div>
    <div class="form__item form__item--last <?=validate_forms_in_errors_array("password", $errors)?>">
    <label for="password">Пароль <sup>*</sup></label>
    <input id="password" type="password" name="password" value="<?=$data["password"]?>" placeholder="Введите пароль">
    <span class="form__error"><?=$errors_messages["invalid_password"] === "" ? "Введите пароль" : $errors_messages["invalid_password"]?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>
</main>
