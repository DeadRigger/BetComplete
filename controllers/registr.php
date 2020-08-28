<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

require_once $way['class_user'];

if($_POST['name'] == ""){ $profile = 'name';}
if($_POST['email'] == ""){ $profile = 'email';}
if($_POST['password'] == ""){ $profile = 'password';}
if($_POST['confirm'] == ""){ $profile = 'confirm';}
if($_POST['password'] != $_POST['confirm']){ $profile = 'do_no_match';}

$user = new User();
$res = $user->create($_POST['name'], $_POST['email'], $_POST['password']);
if($res == false){
    $profile = false;
    echo "Что-то пошло не так";
}else{
    $profile = $_POST['name'];
    $user->authorize($_POST['email'], $_POST['password']);
    echo "<meta http-equiv = 'refresh' content = '0, URL=\"/\"' >";
}
?>
