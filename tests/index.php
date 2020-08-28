<? 
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
//Выбор языка
require_once $way['russian'];

require_once $way['class_user'];
$user = new User();
if($user->getData($_SESSION['id'])['status']!='Администратор'){
    header("HTTP/1.0 404 Not Found");
    exit();
} 
?>

<meta charset="utf-8">

<?
include 'simple_html_dom.php';
include 'class_test.php';
    
// Create DOM from URL or file
$html = file_get_html('https://www.hltv.org/matches?status=Upcoming');

// Поиск всей информации о матче
foreach($html->find('.match-day') as $element){
    $date = $element->find('span',0)->plaintext;
    foreach($element->find('a') as $a){
        if($a->find("td", 1)->class != 'placeholder-text-cell'){
            $cat_id = 1;
            $datetime = strtotime('+1 hour', strtotime($date.$a->find('td',0)->plaintext));
            $matches[] = array(
                'date' => date('Y-m-d', $datetime),
                'event' => $a->find('.event',0)->plaintext,
                'event_logo' => $a->find('.event img',0)->src,
                'time' => date('H:i:s', $datetime),
                'team_l' => $a->find('.team',0)->plaintext,
                'logo_l' => $a->find('.logo',0)->src,
                'team_r' => $a->find('.team',1)->plaintext,
                'logo_r' => $a->find('.logo',1)->src,
            );    
        }
    } 
}

$b = new Bet();
$bets = $b->gets('bets b, event e, team t1, team t2', 'b.*, e.name as event, e.icon as event_logo, t1.name as team_l, t1.icon as logo_l, t2.name as team_r, t2.icon as logo_r', ' where b.id_event=e.id and t1.id=b.team_l and t2.id=b.team_r and b.status="В ожидании"');

//Сколько строк спарсилось
echo 'Спарсилось строк: '.count($matches).'<br>';

$k=1;
while($bet = $bets->fetch()){
    foreach($matches as $i=>$match){
        if($bet['date']==$match['date'] and $bet['event']==$match['event'] and $bet['event_logo']==$match['event_logo'] and $bet['time']==$match['time'] and $bet['team_l']==$match['team_l'] and $bet['logo_l']==$match['logo_l'] and $bet['team_r']==$match['team_r'] and $bet['logo_r']==$match['logo_r']){
            unset($matches[$i]);
        }
    }
}

//Добавленные/ый матч
print_r($matches);

//Добавляем команды и события
foreach($matches as $match){
    $b->addEvent($match['event'], 1, $match['event_logo']);
    $b->addTeam($match['team_l'], 1, $match['logo_l']);
    $b->addTeam($match['team_r'], 1, $match['logo_r']);
}

//Добавляем матчи
foreach($matches as $match){
    $event_id = $b->addEvent($match['event'], 1, $match['event_logo']);
    $team_l = $b->addTeam($match['team_l'], 1, $match['logo_l']);
    $team_r = $b->addTeam($match['team_r'], 1, $match['logo_r']);
    $b->add($match['date'], $match['time'], $event_id, $team_l, $team_r);
}

//Сколько строк записано
echo '<br>Добавлено строк: '.count($matches);
?>

<!--
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Ставки на киберспорт</title>

    <link rel="stylesheet" type="text/css" href="/vendors/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/tests/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/views/css/enter.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/font-awesome/css/font-awesome.min.css">

    <script type="text/javascript" src="/vendors/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/vendors/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/vendors/js/popper.min.js"></script>
</head>

<body>
    <div class="match bg-dark">
        <div class="second-data col-md-1 text-white">
            <p class="category" style="margin: 0">CSGO</p>
        </div>

        <div class="left_team col-md-3 text-white">
            <? if($a->find('.logo',0)->src){ ?>
            <img class="my-1" src="<? echo $a->find('.logo',0)->src; ?>">
            <? } ?>
            <p><? echo $a->find('.team',0)->plaintext; ?></p>
        </div>

        <div class="info col-md-5 align-items-center">
            <div class="col-md-2 col-no-pad col-3 text-white">
                <div class="ratio rate_l col-md-12 border rounded">
                    <? echo '-'; ?>
                </div>
            </div>

            <div class="col-md-8 col-6 float-left text-white">
                <div class="time_bet">
                    <? echo $date.' '.$a->find('td',0)->plaintext; ?>
                </div>
                <div class="text-event">
                   <a onclick="go_event()">
                       <b><? echo $a->find('td',4)->plaintext; ?></b>
                   </a>
               </div>
            </div>

            <div class="col-md-2 col-no-pad col-3 text-white">
                <div class="ratio rate_r col-md-12 border rounded">
                    <? echo '-'; ?>
                </div>
            </div>
        </div>

        <div class="right_team col-md-3 text-white">
            <? if($a->find('.logo',1)->src){ ?>
            <img class="my-1" src="<? echo $a->find('.logo',1)->src; ?>">
            <? } ?>
            <p><? echo $a->find('.team',1)->plaintext; ?></p>
        </div>
    </div>
    <script type="text/javascript" src="/views/js/script.js"></script>
    <script type="text/javascript" src="/views/js/modal_wind.js"></script>
    <script type="text/javascript" src="/views/js/authorization.js"></script>
</body>
</html>
-->
