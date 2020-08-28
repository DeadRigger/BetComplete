<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
require_once $way['class_user'];

//Проверка на логин и пароль в сессиях
$user = new User();
if($user->isAuthorized()){
    echo $user->save($_SESSION['id'], $_POST['email'], $_POST['name'], $_POST['surname'], $_POST['fathername'], $_POST['gender'], $_POST['country'], $_POST['city'], $_POST['address'], $_POST['phone'], $_POST['birthday']);
}
else{ 
    echo 'Вы не зарегистрированы';
    return;
}
?>