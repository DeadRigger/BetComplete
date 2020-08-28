<a class="navbar-brand" href="/">
    <img src="/img/icon-brand.png" width="150" height="auto" alt="BetComplete - ставки на спорт с лучшими коэффициентами" style="max-width: 100%;">
</a>
<div id="sys_enter" class="form-inline justify-content-end">
   <? if ($profile == false):

    include $way['login'];

    else: 

    include $way['entered'];

    endif ?>
</div>