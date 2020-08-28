<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

require_once $way['class_user'];
require_once $way['class_transaction'];

//Проверка на логин и пароль в сессиях
$user = new User();
if($user->isAuthorized()){
    $trans = new Transaction();
    $pays = $trans->getPayments($_SESSION['id']);
}
else{
    echo 'Вы не зарегистрированы';
    return;
}
?>

<h2><? echo $lang['payments'];?></h2>
<hr>
<!-- Datatables -->
<div class="table-responsive">
<table id="example-datatables" class="table table-sm table-bordered" style="white-space: nowrap;">
    <thead>
        <tr class="thead-dark text-center">
            <th><? echo $lang['id']?></th>
            <th><? echo $lang['date']?></th>
            <th><? echo $lang['cash']?></th>
            <th><? echo $lang['type']?></th>
            <th><? echo $lang['status']?></th>
        </tr>
    </thead>
    <tbody>
        <? while($row = $pays->fetch()){?>
        <tr class="thead-light text-center">
            <td><? echo $row['id']?></td>
            <td><? echo $row['time']?></td>
            <td><? echo $row['count']?></td>
            <td><? echo $row['currency']?></td>
            <td>
                <? 
                switch($row['status']){
                    case 0: echo $lang['pay_wait']; break;
                    case 1: echo $lang['pay_ok']; break;
                    case 2: echo $lang['pay_cancel']; break;
                }
                ?>
            </td>
        </tr>
        <? }?>
    </tbody>
</table>
</div>