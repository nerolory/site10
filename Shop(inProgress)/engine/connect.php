<?php


// class Connect {

//     function __construct(DB_DRIVER,DB_HOST, DB_NAME, DB_USER,DB_PASS)
//     {

//     }

// }


function conn()
{
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str, DB_USER, DB_PASS);
    if (!$db) {
        die("Connection Failes: " . $db->errorInfo());
    }
    return $db;
}
