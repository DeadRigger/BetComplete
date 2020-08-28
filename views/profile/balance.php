<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

require_once $way['class_user'];
require_once $way['class_bill'];

//Проверка на логин и пароль в сессиях
$user = new User();
if($user->isAuthorized()){
    $b = new Bill();
    $bills = $b->getBills($_SESSION['id']);
}
else{
    echo 'Вы не зарегистрированы';
    return;
}
?>

<h2><? echo $lang['balance'];?></h2>
<hr>
<div class="container">
    <div class="row align-items-center">
    <? while($row=$bills->fetch()){?>
        <div class="card float-left mr-2">
          <div class="card-body"><!-- Начало текстового контента -->
            <h3><?
                if($row['currency']=='RUB'){ echo $lang['rub_bill'];}
                elseif($row['currency']=='USD'){ echo $lang['usd_bill'];}
                elseif($row['currency']=='BTC'){ echo $lang['btc_bill'];}
            ?></h3>
            <h4><? echo $lang[$row['currency']].' '.$row['count'];?></h4>
          </div><!-- Конец текстового контента -->
        </div><!-- Конец карточки -->
        
        <? 
            if($row['currency'] == 'RUB'){ $sum += $row['count'];}
            elseif($row['currency'] == 'USD'){
                $date = date("d/m/Y"); // Текущая дата
                $content = simplexml_load_file("https://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date);

                foreach($content->Valute as $cur) { 
                    if($cur->NumCode == 840) { $usd = str_replace(",", ".", $cur->Value); } // Доллар США
                }
                $sum += $row['count']*$usd;
            }
            elseif($row['currency'] == 'BTC'){ 
                $tick = file_get_contents('https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=RUB');
                $data = json_decode($tick, TRUE);
                $bit = $data[0]["price_rub"];
                $sum += $row['count']*$bit;
            }
        }
        $b->close();
        ?>
    
        <div class="card-body "><!-- Начало текстового контента -->
            <h4 class="card-title">Общая сумма</h4>
            <h6 class="card-subtitle mb-2 text-muted">В рублях</h6>
            <h5 class="card-text"><? echo $sum.' '.$lang['RUB'];?></h5>
        </div><!-- Конец текстового контента -->
    </div>
</div>