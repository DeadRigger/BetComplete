<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];


require_once $way['class_user'];

//Проверка на логин и пароль в сессиях
$user = new User();
$user->connectdb($db);
if($user->isAuthorized()){
    
}
else{
    echo 'Вы не зарегистрированы';
    return;
}
?>

<h2><? echo $lang['withdraw'];?></h2>
<hr>
<div class='container'>
    <div id="data_pay" style="display:none"></div>
    <div class="row pay_systems">
        <? foreach($paysystem as $key=>$value){?>
        <div id="<? echo $key?>" class="card repl float-left" onclick="$('.repl').toggle(); $(this).show(); $('#data_pay').toggle('slow'); $('#data_pay').load('<? echo $value?>');">
          <div class="card-body text-center"><!-- Начало текстового контента -->
            <a><img src="img/<? echo $key?>.png" style="width:auto; max-width:100%; height:auto; max-height:58px"></a>
          </div><!-- Конец текстового контента -->
        </div><!-- Конец карточки -->
        <?}?>
    </div>
</div>