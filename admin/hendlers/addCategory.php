<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
require_once $way['class_category'];

$category = new Category();
$result = $category->addCategory($_POST['name'], $_POST['description']);
if($result){
    echo "Категория добавлена";
}
else{
    echo "Категория была обновлена";
}

?>