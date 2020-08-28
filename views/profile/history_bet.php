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
    $matchs = $trans->getTransactions($_SESSION['id']);
}
else{
    echo 'Вы не зарегистрированы';
    return;
}
?>
<h2><? echo $lang['bet_history'];?></h2>
<hr>
<!-- Datatables -->
<div class="table-responsive">
<table id="example-datatables" class="table table-sm table-bordered" style="white-space: nowrap;">
    <thead>
        <tr class="thead-dark">
            <th class="text-center"><? echo $lang['ticket']?></th>
            <th class="text-center"><? echo $lang['time']?></th>
            <th class="text-center"><? echo $lang['details']?></th>
            <th class="text-center"><? echo $lang['team']?></th>
            <th class="text-center"><? echo $lang['odds']?></th>
            <th class="text-center"><? echo $lang['cash']?></th>
            <th class="text-center"><? echo $lang['status']?></th>
        </tr>
    </thead>
    <tbody>
        <? 
        $i = 1;
        while($row = $matchs->fetch()){
            if($row['status'] == 'В ожидании' or $row['status'] == 1){
                $color='-warning';
                $status='В ожидании';
            }
            elseif($row['status'] == 'Завершён' or $row['status'] == 3){
                if($row['winner']==$row['team_id']){
                    $color='-success';
                    $status='Победа';
                }
                else{
                    $color='-danger';
                    $status='Проигрыш';
                }
            }
            elseif($row['status'] == 'Live'){
                $color='-primary';
                $status='Live';
            }
            elseif($row['status'] == 'Отменён'){
                $color='-black';
                $status='Отменён';
            }
            
        ?>
        <tr class="thead-light">
            <td><? echo $_SESSION['id'].$row['type'].$row['id']; ?></td>
            <td><? echo date('H:i d-m-y', strtotime($row['timestamp'])); ?></td>
            <td><? echo $row['category'].", ".$row['event'].", ".date('d-m-y', strtotime($row['date']))." ".date('H:i', strtotime($row['time'])); ?></td>
            <td><? echo $row['team']; ?></td>
            <td><?
                if($row['ratio'] == 0){
                    if($row['team_l'] == $row['team_id']){ echo $row['team_l_rate'];}
                    elseif($row['team_r'] == $row['team_id']){ echo $row['team_r_rate'];}
                }
                else echo $row['ratio']; 
            ?></td>
            <td><? echo $row['count'].' '.$lang['RUB'];?></td>
            <td><span class="text<? echo $color; ?>"><? echo $status;?></span></td>
        </tr>
        <? 
            $i += 1;
        }
        ?>
    </tbody>
</table>
</div>
<!-- END Datatables -->
<!-- Javascript code only for this page -->
<script>
    $(function(){
        /* Initialize Datatables */
        $('#example-datatables').dataTable({ columnDefs: [ { orderable: false, targets: [ 0 ] } ] });
        $('.dataTables_filter input').attr('placeholder', 'Search');
    });
</script>