<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Лучшие коэффициенты на киберспорт">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    
    <title>Ставки на киберспорт - BetComplete</title>

    <link rel="stylesheet" type="text/css" href="<? echo $way['css_bootstrap'];?>" />
    <link rel="stylesheet" type="text/css" href="<? echo $way['css_style'];?>" />
    <link rel="stylesheet" type="text/css" href="<? echo $way['css_enter'];?>" />
    <link rel="stylesheet" type="text/css" href="<? echo $way['css_fa'];?>">

    <script type="text/javascript" src="<? echo $way['js_jquery'];?>"></script>
    <script type="text/javascript" src="<? echo $way['js_bootstrap'];?>"></script>
    <script type="text/javascript" src="<? echo $way['js_popper'];?>"></script>
    
</head>

<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark border-header">
       <? include $way['nav'];?>
    </nav>
    
    <article class="container">
        <? include $article;?>
    </article>
    
    <footer class="footer">
        <? include $way['footer'];?>
    </footer>
    
    <? require_once $way['modal_match']; 
    require_once $way['modal_event'];?>
    
    <div id="notifies"></div>
   
    <script type="text/javascript" src="<? echo $way['js_authorization'];?>"></script>
    <script type="text/javascript" src="<? echo $way['js_script'];?>"></script>
    <script type="text/javascript" src="<? echo $way['js_modal'];?>"></script>
</body>
</html>