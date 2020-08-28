<?
switch($error){
    case 400: $text ='Ooops.. <strong>Bad Request</strong>!'; break;
    case 401: $text ='Ooops.. <strong>Unauthorized</strong>!'; break;
    case 403: $text ='Ooops.. <strong>Forbidden</strong>!'; break;
    case 404: $text ='Ooops.. <strong>Page not found</strong>!'; break;
    case 500: $text ='Ooops.. <strong>Internal Server Error</strong>!'; break;
    case 503: $text ='Ooops.. <strong>Service Unavailable</strong>!'; break;
}
?>
<!-- 400 Error -->
<div id="error-tabs-400" class="tab-pane row">
    <div class="col-md-offset-2 col-md-8">
        <div class=" error-container">
            <div class="error-code"><i class="fa fa-exclamation-triangle"></i> <? echo $error;?></div>
            <div class="error-text"><? echo $text;?></div>
            <div class="col-12 text-center">
                <a href="/" class="btn btn-primary">На главную</a>
            </div>
        </div>
    </div>
</div>
<!-- END 400 Error -->