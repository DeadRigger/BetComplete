<? while($row=$events->fetch()){?>
<div class="match container bg-dark" id="event<? echo $row['id'];?>">
    <div class="event-header row" onclick="toggleEvent('#event<? echo $row['id'];?>')">
        <div class="col-md-3" style="line-height:6; text-align: center">
            <img class="icon_name" style="vertical-align: middle; width:auto; max-width:100%; height:auto; max-height:6em" src="<? echo 'img'.$row['icon'];?>" alt="<? echo $row['name'];?>">
        </div>
        <div class="col-md-9">
            <p style="margin-bottom: 0;"><? echo date('d '.$lang[date('F',strtotime($row['date']))].' Y',strtotime($row['date']));?></p>
            <input class="date_for_modal" type="hidden" value="<? echo $row['date']?>">
            <b class="event_name" style="font-size: 2em"><? echo $row['name'];?></b>
            <p class="category_name" style="margin-bottom: 0;"><? echo $row['category'];?></p>
        </div>
    </div>
    
    <div class="event-content row" style="display: none">
    <?
    $teams = $b->teams($row['id']);

    while($team=$teams->fetch()){
        if($row['status'] <> 3){?>
        <div class="event-team align-items-center team<? echo $team['id'];?>" data-toggle="modal" data-target="#event-data" data-event="<? echo $row['id'];?>" data-rate="<? if($team['ratio']== 0){ echo '99';} else { echo $team['ratio'];}?>" data-team="<? echo $team['id'];?>">
            
        <?}else{?>
        <div class="event-team align-items-center team<? echo $team['id'];?>">
            <? if($row['winner']==$team['id']) $bold='font-weight-bold';
            else $bold='';
        }?>
            <div class="col-9 float-left" style="height: 3em; line-height: 3em">
                <p class="float-left mx-2"><? echo $team['name'];?></p>
                <? if($team['icon'] != 'img/no avatar.png'):?>
                <img class="my-1" src="<? echo 'img'.$team['icon']; ?>">
                <? else: ?>
                <img class="my-1" src="">
                <? endif ?>
            </div>

            <div class="col-3 float-left text-center">
                <div class="ratio float-left col-md-12 border rounded <? echo $bold?>"><? if($team['ratio'] >= 10){ echo round( $team['ratio'], 0, PHP_ROUND_HALF_ODD);} else { echo $team['ratio'];}?></div>
            </div>
        </div>
    <?}?>
    </div>

</div>
<?}?>