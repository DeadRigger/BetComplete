<?
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

require_once $way['class_user'];
require_once $way['class_transaction'];
require_once $way['class_bet'];

if(!$_POST['bet']){
    echo $lang['no_bet'];
    return;
}

$b = new Bet();
$bet = $b->getr($_POST['bet']);
if($bet['status'] == $lang['status_complete'] or $bet['status'] == $lang['status_cancel']){
    echo 'Ставка не может быть сделана';
    return;
}

if(!$_POST['cash']){
    echo $lang['no_cash'];
    return;
}

if($_POST['category'] != $bet['category']){
    echo $lang['no_category'];
    return;
}

if(!($_POST['team'] == $bet['left_team'] or $_POST['team'] == $bet['right_team'])){
    echo $lang['no_team'];
    return;
}

if($_POST['team'] == $bet['left_team']){ $team = $bet['left_id'];}
else{ $team = $bet['right_id'];}

if(!$_POST['how_team']){
    echo $lang['no_how_team'];
    return;
}
else{
    if($_POST['how_team'] == 'rate_l'){
        if(!$bet['team_l_rate']){
            if(!$bet['team_r_rate']){         
                $rate = 1.90;
            }else{
                $rate = 4.60;
            }
        } else {
            if(!$bet['team_r_rate']){         
                $rate = 1.20;
            }
            else{
                $rate = (float)$bet['team_l_rate'];
            }
        }
    }elseif($_POST['how_team'] == 'rate_r'){
        if(!$bet['team_l_rate']){
            if(!$bet['team_r_rate']){         
                $rate = 1.90;
            }else{
                $rate = 1.20;
            }
        } else {
            if(!$bet['team_r_rate']){         
                $rate = 4.60;
            }
            else{
                $rate = (float)$bet['team_r_rate'];
            }
        }
    }
}

//Проверка на логин и пароль в сессиях
$user = new User();
$user->connectdb($db);
if($user->isAuthorized()){
    $user->close();
    $transaction = new Transaction();
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;

    if($transaction->add($_POST['cash'], $_POST['bet'], $_SESSION['id'], $team, $ip, $rate, $bet['status'])){
            
        $transaction->update($_POST['bet'], $_POST['cash'], $_SESSION['id'], $_POST['how_team'], $bet['status']);
        echo 'Ставка успешно сделана';
    }
}
else{ 
    echo 'Вы не зарегистрированы';
    $user->close();
}
?>