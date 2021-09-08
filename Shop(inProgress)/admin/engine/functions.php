<?php
include "../../config/config.php";
include "../../engine/connect.php";


function goodsOut()
{
    $db = conn();
    $query = $db->query("SELECT * FROM goods");
    if ($query->rowCount() > 0) {
        $out = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0 results";
    }
    exit;
}

function init()
{
    $db = conn();
    $query = $db->query("SELECT id, name FROM goods");
    if ($query->rowCount() > 0) {
        $out = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0 results";
    }
    exit;
}

function selectOneGood()
{
    $db = conn();
    $id = $_POST['gid'];
    $query = $db->query("SELECT * FROM goods WHERE id = '$id' ");
    if ($query->rowCount() > 0) {
        $row = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);
    } else {
        echo "0 results";
    }
    exit;
}

function updateGood()
{
    $db = conn();

    $id = $_POST['gid'];
    $name = $_POST['gname'];
    $cost = $_POST['gcost'];
    $descr = $_POST['gdescr'];
    $ord = $_POST['gord'];
    $img = $_POST['gimg'];

    if ($id != 0) {
        $sql = "UPDATE goods SET name = '$name',cost = '$cost',description = '$descr',ord = '$ord',img = '$img' Where id = '$id' ";
    } else {
        $sql = "INSERT goods (name ,cost,description,ord,img) VALUES('$name','$cost','$descr', '$ord', '$img')";
    }
    if ($db->query($sql)) {
        echo "update Succesfully";
    } else {
        echo "update Failes: " . $db->errorInfo();
    }
    exit;
}

function deleteGoods()
{

    $db = conn();
    $id = $_POST['id'];
    $sql = "DELETE FROM goods WHERE id='$id' ";
    if ($db->query($sql)) {
        echo "1";
    } else {
        echo "Error deleting record: " . $db->errorInfo();
    }
    exit;
}

function writeJSON()
{

    $db = conn();
    $query = $db->query("SELECT * from goods");
    if ($query->rowCount() > 0) {
        $out = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $out[$row["id"]] = $row;
        }
        file_put_contents('../../goods.json', json_encode($out));
    } else {
        echo "0 results";
    }
    exit;
}
