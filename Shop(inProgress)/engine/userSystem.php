<?php

function login()
{
    $login = $_POST['login'];
    if (isset($_POST['login'])); {
        // connectivity to MySQL server
        $db = conn();

        // after pressing login, checking if the variables exist in the database
        $query = $db->prepare("SELECT pass FROM users WHERE login=?");
        $query->execute(array($_POST['login']));
        if ($query->fetchColumn() === md5($_POST['pass'])) {
            // starts the session created if login info is correct
            session_start();
            $user = $db->query("SELECT * FROM users WHERE login = $login")->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = [
                "id" => $user['id'],
                "login" => $user['login'],
                "email" => $user['email'],
                "property" => $user['property'],
                "checkmail" => $user['checkmail']
            ];
            header("location: /index.php");
            exit;
        }
    }
}

function signUp()
{
    // соединение с сервером
    $db = conn();

    //получаем $_POST
    $loginReg = strip_tags($_POST['login']);
    $emailReg = strip_tags($_POST['email']);
    $passwordReg = md5(strip_tags($_POST['password']));
    $checkPasswordReg = md5(strip_tags($_POST['checkPassword']));

    // Проверка полей ввода на валидацию
    if (!isset($_POST['regCheckbox'])) {
        // чекбокс согласие с правилами
        $_SESSION['message'] = "Вы не согласились с политикой сайта";
        header("location: /index.php?page=reg");
        return;
    }
    if ($passwordReg != $checkPasswordReg) {
        // Сравнение паролей
        $_SESSION['message'] = "пароли не совпадают";
        header("location: /index.php?page=reg");
        return;
    }

    if ($loginReg == "" || $emailReg == "" || $_POST['password'] == "") {
        // Проверка пустых полей
        $_SESSION['message'] = "Заполните все поля!";
        header("location: /index.php?page=reg");
        return;
    }

    // Проверка логина и почты на угикальность
    $query = $db->prepare("SELECT login,email FROM users WHERE login=? OR email=?");
    $query->execute(array($_POST['login'], $_POST['email']));
    $row = $query->fetch();
    if (!$row) {
        $query = $db->prepare("INSERT INTO `users` (`login`, `email`, `pass`, `property`, `checkmail`) VALUES (?, ?, ?, 'user', '0')");
        $query->execute(array($loginReg, $emailReg, $passwordReg,));
        login();
    } else {
        $_SESSION['message'] = "такие логин или email уже зарегистрированы";
        header("location: /index.php");
    }
}

function sesDestr()
{
    session_destroy();
    header("location: /index.php");
}
