<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

require_once $way['class_user'];
require_once $way['class_bet'];
$user = new User();
if($user->getData($_SESSION['id'])['status'] == 'Администратор'){
    $b = new Bet();
    if($_POST['type'] == 'match'){
        if($b->changeMatch($_POST['id'], $_POST['status'], $_POST['winner'], $_POST['translation'])){
            echo 'Успешно изменено';
        }else{
            echo 'Либо вы ничего не изменили, либо что-то не так';
        }
        return;
    }elseif($_POST['type'] == 'event'){
        if($b->changeEvent($_POST['id'], $_POST['winner'])){
            echo 'Успешно выполнено';
        }else{
            echo 'Что-то не так с базой данных';
        }
        return;
    }
    $bets = $b->gets();
    $events = $b->getEvents();
}
else{
    echo "<meta http-equiv = 'refresh' content = '0, URL=\"/\"' >"; 
    return;
}
?>

<!-- Tiles -->
<!-- Row 1 -->
<div class="row">
    <!-- Column 1 of Row 1 -->
    <div class="col-sm-12">
        <!-- Datatables Tile -->
        <div class="dash-tile dash-tile-2x">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Manage Orders"><i class="fa fa-cogs"></i></a>
                </div>
                Ближайшие матчи
            </div>
            <div class="dash-tile-content">
                <div class="dash-tile-content-inner-fluid">
                    <table id="dash-example-orders" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Дата</th>
                                <th class="text-center">Время</th>
                                <th class="text-center">Событие</th>
                                <th class="text-center">Дисциплина</th>
                                <th class="text-center">Левая команда</th>
                                <th class="text-center">Правая команда</th>
                                <th class="text-center"><i class="fa fa-bolt"></i> Статус</th>
                                <th class="text-center">Выигравшая команда</th>
                                <th class="text-center">Ссылка на видео</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? while($bet = $bets->fetch()){?>
                            <tr id="match<? echo $bet['id']; ?>" class="text-center">
                                <td>
                                    <div class="btn-group">
                                        <a onclick="change_match(<? echo $bet['id']; ?>)" data-toggle="tooltip" title="Изменить" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                                <td><?php echo $bet['date']; ?></td>
                                <td><?php echo $bet['time']; ?></td>
                                <td><?php echo $bet['event']; ?></td>
                                <td><?php echo $bet['category']; ?></td>
                                <td><?php echo $bet['left_team']; ?></td>
                                <td><?php echo $bet['right_team']; ?></td>
                                <td>
                                    <select>
                                     <? echo $bet['status'];
                                      if($lang['status_live'] == $bet['status']){
                                        echo '<option value="'.$lang['status_live'].'" selected>'.$lang['status_live'].'</option>';
                                      }else{ 
                                        echo '<option value="'.$lang['status_live'].'">'.$lang['status_live'].'</option>';
                                      } 
                                                            
                                      if($lang['status_complete'] == $bet['status']){
                                        echo '<option value="'.$lang['status_complete'].'" selected>'.$lang['status_complete'].'</option>';
                                      }else{ 
                                        echo '<option value="'.$lang['status_complete'].'">'.$lang['status_complete'].'</option>';
                                      } 
                                                            
                                      if($lang['status_pending'] == $bet['status']){
                                        echo '<option value="'.$lang['status_pending'].'" selected>'.$lang['status_pending'].'</option>';
                                      }else{ 
                                        echo '<option value="'.$lang['status_pending'].'">'.$lang['status_pending'].'</option>';
                                      } 
                                                            
                                      if($lang['status_cancel'] == $bet['status']){
                                        echo '<option value="'.$lang['status_cancel'].'" selected>'.$lang['status_cancel'].'</option>';
                                      }else{ 
                                        echo '<option value="'.$lang['status_cancel'].'">'.$lang['status_cancel'].'</option>';
                                      } 
                                      ?>
                                    </select>
                                </td>
                                <td><?
                                    if(!$bet['winner'] and $bet['status']=='Live'){?>
                                    <select>
                                        <option value="0" selected>Выберите победителей</option>
                                        <option value="<?php echo $bet['left_id']; ?>">
                                            <?php echo $bet['left_team']; ?>
                                        </option>
                                        <option value="<?php echo $bet['right_id']; ?>">
                                            <?php echo $bet['right_team']; ?>
                                        </option>
                                    </select>
                                    <?    
                                    }elseif($bet['status']=='Завершён') {
                                        if($bet['winner'] == $bet['left_id']){
                                            echo $bet['left_team'];
                                        }elseif($bet['winner'] == $bet['right_id']){
                                            echo $bet['right_team'];
                                        }
                                    }
                                ?></td>
                                <td><input type='text' value="<?php echo $bet['translation']; ?>"></td>
                            </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Datatables Tile -->
    </div>
    <!-- END Column 1 of Row 1 -->
    <!-- Column 2 of Row 1 -->
    <div class="col-md-6">
        <!-- Datatables Tile -->
        <div class="dash-tile dash-tile-2x">
            <div class="dash-tile-header">
                <div class="dash-tile-options">
                    <a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" title="Manage Orders"><i class="fa fa-cogs"></i></a>
                </div>
                Ближайшие события
            </div>
            <div class="dash-tile-content">
                <div class="dash-tile-content-inner-fluid">
                    <table id="dash-example-orders" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Время</th>
                                <th class="text-center">Дисциплина</th>
                                <th class="text-center">Событие</th>
                                <th class="text-center">Победившая команда</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? while($event = $events->fetch()){?>
                            <tr id="event<? echo $event['id']; ?>" class="text-center">
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a onclick="change_event(<? echo $event['id']; ?>)" data-toggle="tooltip" title="Change" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                                <td><? echo $event['date']; ?></td>
                                <td><? echo $event['category']; ?></td>
                                <td><? echo $event['name']; ?></td>
                                <td><? 
                                  if($event['status'] == 1){?>
                                    <select>    
                                        <option value=0>Выберите команду</option>
                                        <?$teams = $b->getTeams($event['id']); 
                                        while($row=$teams->fetch()){?>
                                        <option value=<? echo $row['id'];?>><? echo $row['name'];?></option>
                                        <?}?>
                                    </select>
                                  <?}elseif($event['status'] == 0){ 
                                      echo $event['winner'];
                                  } ?>
                                </td>
                            </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Datatables Tile -->
    </div>
    <!-- END Column 2 of Row 1 -->
</div>
<!-- END Row 1 -->
<!-- END Tiles -->

<script>
function change_match(id){
    var status = $('#match'+id+' select:eq(0)').val()
    var winner = $('#match'+id+' select:eq(1)').val()
    if(winner==undefined){ winner = null}
    var video = $('#match'+id+' input').val()
    
    $.ajax({
        url: 'template/tracing.php',
        type: 'POST',
        data: "type=match"+"&id="+id+"&status="+status+"&winner="+winner+"&translation="+video,
        success: function(data){
            system_alert(data, 'success')
        },
        error: function () {
            system_alert('Ошибка!', 'danger');
        }
    });    
}
function change_event(id){
    var winner = $('#event'+id+' select').val()
    
    $.ajax({
        url: 'template/tracing.php',
        type: 'POST',
        data: "type=event"+"&id="+id+"&winner="+winner,
        success: function(data){
            system_alert(data, 'success')
        },
        error: function () {
            system_alert('Ошибка!', 'danger');
        }
    });    
}
</script>