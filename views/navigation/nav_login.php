<?
require_once $way['class_user'];

//Проверка на логин и пароль в сессиях
$user = new User();
if($user->isAuthorized()){
    $user->close();
}
else{
    echo 'Вы не зарегистрированы';
}
?>

<ul class="nav justify-content-end">
    <li class="nav-item dropdown bg-dark" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
        <? 
        require_once $way['class_bill'];
        $bills = new Bill();
        $sth = $bills->getBills($_SESSION['id']);
        $row = $sth->fetch();
        if($row){
        ?>
        <div class="nav-link text-warning">
            <b class="text-white"><? echo $lang['bill'];?></b>
            <b id="person_money" style="margin-left: 5px;"><? echo round($row['count'],2);?></b>
            <? echo $lang['RUB'];?>
        </div>
        <? }else{?>
        
        <h5 class="my-3 text-warning" style="float: left;"><? echo $lang['no_bill'];?></h5>
        
        <?
        }
        ?>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>
        <h5 style="float: left;"><? echo $profile; ?></h5>
        </a>
        <div class="dropdown-menu" style="left: auto; right: 0">
           <? if($user_status != "Неактивирован"): ?>
            <a class="dropdown-item" href="/profile.php"><? echo $lang['profile'];?></a>
           <? if($user_status == "Администратор"): ?>
            <a class="dropdown-item" href="/admin"><? echo $lang['control_panel'];?></a>
            <? endif ?>
            <? endif ?>
            <a href="<? echo $way['exit'];?>" class="dropdown-item"><? echo $lang['exit'];?></a>
        </div>
    </li>
</ul>

<script>

</script>
