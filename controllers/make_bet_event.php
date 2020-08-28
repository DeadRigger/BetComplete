<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

require_once $way['class_user'];
require_once $way['class_transaction'];

//Проверка на логин и пароль в сессиях
$user = new User();
$user->connectdb($db);
if($user->isAuthorized()){
    $user->close();
    $transaction = new Transaction();
    $transaction->connectdb($db);
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;

    if($transaction->addBetOnEvent($_POST['cash'], $_POST['event_id'], $_POST['team_id'], $_SESSION['id'], $ip)){
        if(!$transaction->updateBetOnEvent($_POST['cash'], $_POST['event_id'], $_POST['team_id'], $_SESSION['id'])){
            echo 'Не удалось обновить данные';
        }else{
            echo 'Ставка успешно сделана';
        }
    }
    else echo 'Что-то пошло не так';
    $transaction->close();
}
else{ 
    echo 'Вы не зарегистрированы';
    $user->close();
}
?>