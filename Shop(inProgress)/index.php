<?php
session_start();
include "config/config.php";
include "engine/connect.php";
include "engine/massGoods.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
</head>

<body>
    <div class="site-content">
        <? include_once "blocks/header.php" ?>
        <? include_once "blocks/userpanel.php" ?>
        <main>
            <? include_once "blocks/left_menu.php" ?>
            <div class="main-part">
                <?php
                if (!isset($_GET['page'])) {
                    $page = 'main';
                } else {
                    $page = $_GET['page'];
                }
                switch ($page) {
                    case 'main':
                        include_once "blocks/main_part.php";
                        break;
                    case 'reg':
                        if (!isset($_SESSION['user'])) {
                            include_once "blocks/reg.php";
                        } else {
                            echo "вы уже зарегистрировались и авторизованы 
                        <br> 
                         <a href=' / '> <= Вернуться на главную </a>";
                        }
                        break;
                    case 'login':
                        include_once "blocks/login.php";
                        break;
                    case 'menage_goods':
                        if ($_SESSION['user']['property'] == 'admin') {
                            include_once "blocks/goodEditor.php";
                        } else {
                            include_once "blocks/main_part.php";
                        }
                        break;
                    case 'catalog':
                        include_once "blocks/catalog.php";
                        break;
                    case 'cart':
                        include_once "blocks/cart.php";
                        break; 
                }
                ?>
            </div>
        </main>
        <? include_once "blocks/footer.php" ?>
    </div>
    
</body>

</html>