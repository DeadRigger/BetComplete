<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

require_once $way['class_user'];

if($_POST['login'] == ""){ $profile = 'email';}
if($_POST['password'] == ""){ $profile = 'password';}

$user = new User();
$res = $user->authorize($_POST['login'], $_POST['password']);
if($res == false){
    $profile = false;
    echo "Вы не зарегистрированы"; 
}else{
    echo "<meta http-equiv = 'refresh' content = '0, URL=\"/\"' >";    
}
?>