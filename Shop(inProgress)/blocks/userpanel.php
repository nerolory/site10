<div class="user-panel">
    <div class="mini-cart"><a href="/index.php?page=cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>
    <? if (!isset($_SESSION['user'])) : ?>
        <? $mess = "";
        echo $mess;
        ?>
        <div class="mini-login">
            <form action="../engine/startSession.php" method="post">
                <label>логин</label><input type="text" name="login" id="login" required>
                <label>пароль</label><input type="pass" name="pass" id="pass" required>
                <input type="submit" value="Войти">
            </form>
        </div>
        <div class="reg-button">
            <button onclick="window.location.href = '/index.php?page=reg'">регистрация</button>
        </div>
</div>
<? endif ?>
<? if (isset($_SESSION['user'])) : ?>

    <div class="mini-login">Привет <?= $_SESSION['user']['login'] ?>
        <button onclick="window.location.href='engine/SesDestr.php'">
            Выйти
        </button>
    </div>
    </div>
<? endif ?>