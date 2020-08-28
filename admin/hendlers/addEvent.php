<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
require_once $way['class_event'];

$teams = explode(',',$_POST['teams']);

$event = new Event();
$id = $event->addEvent($_POST['name'], $_POST['category'], $_POST['date'], $_POST['description']);
if($id){
    $event->addTeams_event($teams, $id);
    echo "Событие добавлено";
}
else{
    echo "Такое событие уже есть";
}
?>