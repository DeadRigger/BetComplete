<?
function match($row, $lang, $text_color, $data_rate_left, $data_rate_right, $bg_rate_left='', $bg_rate_right=''){
?>
<div class="match bg-dark" id="match<? echo $row['id'];?>">
    
    <div class="second-data col-md-1">
        <p class="category <? echo $text_color; ?>" style="margin: 0"><? echo $row['category'];?></p>
    </div>

    <div class="left_team <? echo $text_color; ?> col-md-3">
        <? if($row['left_icon'] != 'img/no avatar.png'):?>
        <img class="my-1" src="<? echo $row['left_icon']; ?>">
        <? else: ?>
        <img class="my-1" src="">
        <? endif ?>
        <p><? echo $row['left_team']; ?></p>
    </div>

   <?
   if($row['status']=='Завершён' or $row['status']=='Отменён'){
       $block = '-block';
   }
   ?>
   
    <div class="info col-md-5 align-items-center <? echo $text_color; ?>">
        <div class="col-md-2 col-no-pad col-3">
            <div class="ratio<? echo $block;?> rate_l col-md-12 border rounded <? echo $bg_rate_left; ?>" data-toggle="modal" data-target="#match-data" data-rate="<? echo $data_rate_left; ?>" data-match="match<? echo $row['id'];?>">
            <? if(!$row['team_l_rate']){
                if(!$row['team_r_rate']){         
                    echo '1.90';
                }else{
                    echo '4.60';
                }
            } else {
                if(!$row['team_r_rate']){         
                    echo '1.20';
                }else{
                    echo $row['team_l_rate'];
                }
            } ?>
            </div>
        </div>

        <div class="col-md-8 col-6 float-left">
            <div class="time_bet">
            <? if($row['status'] != 'Live'){
                echo date("j-m-y G:i", strtotime($row['date'].' '.$row['time'])); 
            }else{ echo $lang['play'];}
            ?>
            </div>
            <div class="text-event"><a onclick="go_event()"><b><? echo $row['tournament']; ?></b></a></div>
        </div>
        
        <div class="col-md-2 col-no-pad col-3">
            <div class="ratio<? echo $block;?> rate_r col-md-12 border rounded <? echo $bg_rate_right; ?>" data-toggle="modal" data-target="#match-data" data-rate="<? echo $data_rate_right; ?>" data-match="match<? echo $row['id'];?>">
            <? if(!$row['team_l_rate']){
                if(!$row['team_r_rate']){         
                    echo '1.90';
                }else{
                    echo '1.20';
                }
            } else {
                if(!$row['team_r_rate']){         
                    echo '4.60';
                }else{
                    echo $row['team_r_rate'];
                }
            } ?>
            </div>
        </div>
    </div>

    <div class="right_team <? echo $text_color; ?> col-md-3">
        <? if($row['right_icon'] != 'img/no avatar.png'):?>
        <img class="my-1" src="<? echo $row['right_icon']; ?>">
        <? else: ?>
        <img class="my-1" src="">
        <? endif ?>
        <p><? echo $row['right_team']; ?></p>
    </div>
       
</div>
<?
}
?>

<div style="font-size: 0.8em" class="match bg-dark text-white text-center">
    <div class="col-md-1 float-left"><? echo $lang['status_game'];?></div>
    <div class="col-md-3 float-left text-left"><? echo $lang['left_team'];?></div>
    <div class="col-md-1 float-left"><? echo $lang['rate_1'];?></div>
    <div class="col-md-3 float-left"><? echo $lang['time_and_event'];?></div>
    <div class="col-md-1 float-left"><? echo $lang['rate_2'];?></div>
    <div class="col-md-3 float-left text-right"><? echo $lang['right_team'];?></div>
</div>

<? while($row = $match->fetch()){

//   Выбор цвета для различных статусов матча
switch($row['status']){
//        Если лайв ставка то красим текст в красный
case $lang['status_live']:
    match($row, $lang, 'text-danger', 'left', 'right');
    break;

//        Если матч в ожидании начала, то текст синий
case $lang['status_pending']:
    match($row, $lang, 'text-info', 'left', 'right');
    break;

//        Если матч завершен, то красим в белый
case $lang['status_complete']:
    $bg_l=''; $bg_r='';
    if($row['left_id'] == $row['winner']){
        $winner='win';
        $bg_l='font-weight-bold';
    }
    else {
        $winner='lose';
        $bg_r='font-weight-bold';
    }

    match($row, $lang, 'text-light', $winner, $winner, $bg_l, $bg_r);
    break;

//        Если матч отменен, то красим в оранжевый
case $lang['status_cancel']:
    match($row, $lang, 'text-warning', 'cancel', 'cancel');
    break;

default:}
}?>