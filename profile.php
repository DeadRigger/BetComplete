<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

//Проверка на логин и пароль в сессиях
include $way['class_user'];
$user = new User();
if($user->isAuthorized()){
    $user_data = $user->getData($_SESSION['id']);
    $profile = $user_data['name'];
    $user_status = $user_data['status'];
}

if($_POST['page']){
    switch($_POST['page']){
        case 'profile': $page = include $way['user_data']; return $page;
        case 'balance': $page = include $way['balance']; return $page;
        case 'withdraw': $page = include $way['withdraw']; return $page;
        case 'replenish': $page = include $way['replenish']; return $page;
        case 'payment': $page = include $way['payments']; return $page;
        case 'bet': $page = include $way['bets']; return $page;
    }
}

$article = $way['profile'];

include $way['template'];
?>