<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 17.03.2019
 * Time: 17:22
 */
?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <p>В продаже имеются железнодорожные билеты по направлениям:</p>
            <ul class="ticket_list">
                <?foreach ($items as $item):?>
                <li>
                    <span class="fz20 md"><?= $item->cityFrom->name?> - <?= $item->cityTo->name?></span>
<!--                    <a class="link-md" href="javascript:;">Просмотреть даты</a>-->
                </li>
                <?php endforeach?>
            </ul>
            <p class="mb0">Заявки на билеты отправлять на почту
                <a class="md" href="mailto:pochta@yandex.ru">pochta@yandex.ru</a>
            </p>
        </div>
    </div>
</div>