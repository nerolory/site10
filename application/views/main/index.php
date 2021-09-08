<h1>главная страница</h1>
<h2>Новые товары</h2>

<hr>
<? foreach ($good as $val) : ?>
    <h3><?= $val['name'] ?></h3>
    <p><?= $val['cost'] ?></p>
    <p><?= $val['description'] ?></p>
    <p><img src="/public/images/<?= $val['img'] ?>" width="100px" alt="<?= $val['name'] ?>"></p>
    <hr>
<? endforeach ?>