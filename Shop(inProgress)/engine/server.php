<?
$path = "../files/img" . $_FILES['img']['name'];

if (move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
    echo "файл " . $_FILES['img']['name'] . " загружен!!";
} else {
    echo "Что-то пошло не так";
}
