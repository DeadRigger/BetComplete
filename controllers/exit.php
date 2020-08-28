<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

include $way['class_user'];

$user = new User();
$user->logout();

echo "<meta http-equiv = 'refresh' content = '0, URL=\"/\"' >"; 
?>