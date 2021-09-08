<?

echo "hi " . $_SESSION['user']['login'];
?>
<div class="goods-out">
</div>

<h2>Товар</h2>
<p> Название:<input type="text" id="gname"></p>
<p> Стоимость:<input type="text" id="gcost"></p>
<p> Описание:<textarea id="gdescr"></textarea></p>
<p> Изображение:<input type="text" id="gimg"></p>
<p> Порядок:<input type="text" id="gord"></p>
<input type="hidden" id="gid">
<button class="add-to-db">обновить</button>
<button class="delete-from-db">Удалить</button>
<Script src="public/js/jquery.js"></Script>
<Script src="admin/js/goodMenager.js"></Script>