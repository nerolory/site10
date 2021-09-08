<div class="reg-form">
    <form action="../engine/registration.php" method="post">
        <label> login</label>
        <input type="text" name="login" id="reglogin" required>
        <label> email</label>
        <input type="email" name="email" id="email" required>
        <label> password</label>
        <input type="password" name="password" id="password" value="" required>
        <label> check password</label>
        <input type="password" name="checkPassword" id="checkPassword" required>
        <p>
            <input type="checkbox" name="regCheckbox" id="regCheckbox" required>
            <label> согласиe с политикой сайта.</label>
        </p>
        <input type="submit" value="Регистрация" id="reg-btn">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div id='warning'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        } else {
        }
        ?>
    </form>
</div>