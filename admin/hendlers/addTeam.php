<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
require_once $way['class_team'];

$team = new Team();
$category = $team->getCategory($_POST['category']);

if($_POST['icon']){
    $icon = 'img/'.$category['name'].'/'.$_POST['icon'];
}
else{
    $icon = '';
}

if($team->addTeam($_POST['team'], $_POST['category'], $icon, $_POST['description'])){
    echo "Команда добавлена";
}
else{
    echo "Команда была обновлена";
}
?>