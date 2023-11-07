
<?php
foreach($categories as $value):
    ?>
    <li class="nav__item">
        <a href="all-lots.php?category=<?=$value["name"]?>"><?=htmlspecialchars($value["name"])?></a>
    </li>
<?php endforeach;?>