<div id="live-toggle" class="form-box border-block">
    <div class="card bg-dark">
        <a id="head-translation" class="card-header text-white" data-toggle="collapse" href="#translation" role="button" aria-expanded="false" aria-controls="translation" style="text-decoration: none;">
        <? echo $lang['translation'];?>
        </a>

        <div id="translation" class="collapse" aria-labelledby="headingOne" data-parent="#live-toggle">
          <div class="card-body text-white" style="background-color: #3D3D3D; text-align: center;">
            <? 
            if(!$translation->rowCount()){ echo $lang['no_translation']; }
            else{
            while($t = $translation->fetch()){ ?>
            <iframe class="transplayer col-lg-5" src="<? echo $t['translation'] ?>" frameborder="0" allowfullscreen="true" scrolling="no" height="300" width="520"></iframe>
            <? } }?>
          </div>
        </div>
    </div>
</div>

<nav id="nav-by-bet" class="border-nav">
    <div class="nav nav-tabs nav-fill nav-dark bg-dark" id="nav-tab" role="tablist">
        <a class="nav-point nav-item nav-link" id="nav-live-tab" data-toggle="tab" href="#nav-live" role="tab" aria-controls="nav-live" aria-selected="false">
        <? echo $lang['live'];?>
        </a>
        <a class="nav-point nav-item nav-link active" id="nav-ordinar-tab" data-toggle="tab" href="#nav-ordinar" role="tab" aria-controls="nav-ordinar" aria-selected="true">
        <? echo $lang['bets'];?>
        </a>
<!--
        <a class="nav-point nav-item nav-link" id="nav-express-tab" data-toggle="tab" href="#nav-express" role="tab" aria-controls="nav-express" aria-selected="false">
        <? //echo $lang['express'];?>
        </a>
-->
        <a class="nav-point nav-item nav-link" id="nav-event-tab" data-toggle="tab" href="#nav-event" role="tab" aria-controls="nav-event" aria-selected="false">
        <? echo $lang['event'];?>
        </a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-live" role="tabpanel" aria-labelledby="nav-live-tab">

    </div>
    <div class="tab-pane fade show active" id="nav-ordinar" role="tabpanel" aria-labelledby="nav-ordinar-tab">
      <? include $way['match']; ?>
    </div>
<!--
    <div class="tab-pane fade" id="nav-express" role="tabpanel" aria-labelledby="nav-express-tab">

    </div>
-->
    <div class="tab-pane fade" id="nav-event" role="tabpanel" aria-labelledby="nav-event-tab">

    </div>
</div>

<script>
$( document ).ready(function() {
    setInterval(function(){
        ajax_navtab($('.tab-pane.fade.show.active').attr('id').slice(4))
    }, 10000)
})
</script>