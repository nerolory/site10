<?php

require_once('../config/emailConfig.php');


$json = file_get_contents('../goods.json');
$json = json_decode($json, true);

$message = '';
$message .= '<h1>Заказ в магазине</h1>';
$message .= '<p>телефон: '.$_POST['ephone'].'</p>';
$message .= '<p>email: '.$_POST['email'].'</p>';
$message .= '<p>Клиент: '.$_POST['ename'].'</p>';

$cart = $_POST['cart'];

    $sum = 0;
foreach($cart as $id =>$count){
    $message .= 'товар: '.$json[$id]['name'].'<br>';
    $message .= 'Количество: '.$count.'<br>';
    $message .= 'Цена: '.$json[$id]['cost'].'<br>';
    $message .= 'Итого: '.$count*$json[$id]['cost'].'<br><br>';
    $sum += $count*$json[$id]['cost'];
}
    $message .= 'Всего к оплате: '.$sum.'р.<br><br>';

//print_r($message);

$emailTo = $emailOrderAccepter.',';
$emailTo .= $_POST['email'];

$specText = '
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Заказ</title>
    </head>
    <body>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= $from;

$endMessage = "</body></html>";

$mail = mail($emailTo, $subject, $specText.$message.$endMessage, $headers);

if($mail){echo 1;} else {echo 2;}