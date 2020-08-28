<!-- Page Content -->
<div id="page-content" class="bg-light" style="margin-top: 15px;">

    <!-- Profile -->
    <h3 class="container"><i class="fa fa-user"></i> <? echo $profile; ?> <small><? echo mb_strtolower($user_status, 'UTF-8'); ?></small></h3>

    <div class="row">
        <!-- First Column | Image and menu -->
        <div class="col-md-3">
            <div class="list-group">
                <a id="my_profile" href="#profile" class="list-group-item"><? echo $lang['my_data'];?></a>
                <a id="balance" href="#balance" class="list-group-item"><? echo $lang['balance'];?></a>
                <a id="withdraw" href="#withdraw" class="list-group-item"><? echo $lang['withdraw'];?></a>
                <a id="replenish" href="#replenish" class="list-group-item"><? echo $lang['replenish'];?></a>
                <a id="history_payment" href="#payment" class="list-group-item"><? echo $lang['payments'];?></a>
                <a id="history_bet" href="#bet" class="list-group-item"><? echo $lang['bet_history'];?></a>
                <a href="<? echo $way['exit'];?>" class="list-group-item"><? echo $lang['quit'];?></a>
            </div>
        </div>
        <!-- END First Column | Image and menu -->

        <!-- Second Column | Main content -->
        <div id="main-content" class="col-md-9">
            <? include $way['user_data'];?>
        </div>
        <!-- END Second Column | Main content -->

        <a id="close_profile" class="close" href="/">&times;</a>
    </div>
    <!-- END Profile -->
</div>
<!-- END Page Content -->

<script>
$( document ).ready(function() {
    if(!document.location.hash || document.location.hash == '#profile'){
        ajax_profile('profile')
    }
    else if(document.location.hash == '#balance'){
        ajax_profile('balance')
    }
    else if(document.location.hash == '#withdraw'){
        ajax_profile('withdraw')
    }
    else if(document.location.hash == '#replenish'){
        ajax_profile('replenish')
    }
    else if(document.location.hash == '#payment'){
        ajax_profile('payment')
    }
    else if(document.location.hash == '#bet'){
        ajax_profile('bet')
    }
})
</script>