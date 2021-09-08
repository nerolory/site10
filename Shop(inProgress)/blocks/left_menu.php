<div class="menu-left">
    <div id="links">
        <nav>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/index.php?page=catalog">Каталог</a></li>
                <? if (isset($_SESSION['user'])) : ?>
                    <? if ($_SESSION['user']['property'] == 'admin') : ?>
                        <li><a href="/index.php?page=menage_goods">Добавить товар</a></li>
                    <? endif ?>
                <? endif ?>
            </ul>
        </nav>
    </div>

</div>