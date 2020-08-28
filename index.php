<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

//Проверка на логин и пароль в сессиях
require_once $way['class_user'];
$user = new User();
if($user->entered()){
    $user_data = $user->getData($_SESSION['id']);
    $profile = $user_data['name'];
    $user_status = $user_data['status'];
}

if($_GET['page']){
    $article = $_GET['page'];     
}
else{ $article = $way['article'];}

//Данные о матчах
require_once $way['class_bet'];
$b = new Bet();

if($_POST['nav']){
    
    switch($_POST['nav']){
        case 'live': 
            $match = $b->live(); $nav = include $way['match']; return $nav;
        case 'ordinar': 
            $match = $b->ordinar(); $nav = include $way['match']; return $nav;
        case 'express': 
            $match = $b->express(); $nav = include $way['match']; return $nav;
        case 'event': 
            $events = $b->events(); $nav = include $way['event']; return $nav;
    }
}
else{
    $match = $b->ordinar();
}
//

//Ссылка на трансляцию
$translation = $b->translation();
//

//Нижняя панель навигации

//

include $way['template'];
?>