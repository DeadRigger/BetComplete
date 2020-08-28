<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
require_once $way['class_bet'];

$bet = new Bet();

$result = $bet->add($_POST['event'], $_POST['time'], $_POST['date'], $_POST['team1'], $_POST['rate1'], $_POST['team2'], $_POST['rate2'], $_POST['video']);

if($result){
    echo "Матч добавлен";
}
else{
    echo "Такой матч уже существует уже есть";
}
?>