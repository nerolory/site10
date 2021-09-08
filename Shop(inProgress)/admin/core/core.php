<?php
require_once '../engine/functions.php';

$action = $_POST['action'];

switch ($action) {
    case 'goodsOut':
        goodsOut();
        break;
    case 'init':
        init();
        break;
    case 'selectOneGood':
        selectOneGood();
        break;
    case 'updateGood':
        updateGood();
        break;
    case 'deleteGoods';
        deleteGoods();
        break;
    case 'writeJSON';
        writeJSON();
        break;
}
