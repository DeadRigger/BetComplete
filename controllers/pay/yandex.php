<?
if($_POST['notification_type']){
    require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

    require_once $way['class_transaction'];
    require_once $way['class_bill'];

    if(sha1($_POST['notification_type'].'&'.$_POST['operation_id'].'&'.$_POST['amount'].'&'.$_POST['currency'].'&'.$_POST['datetime'].'&'.$_POST['sender'].'&'.$_POST['codepro'].'&fFpd9+xtnnOsqXZsNtW6Ne5R&'.$_POST['label']) == $_POST['sha1_hash']){
        $t = new Transaction();
        if($_POST['currency'] == '643'){
            $currency = 'RUB';
        }

        if($_POST['notification_type'] == 'p2p-incoming'){
            $paysystem = 'Яндекс.Деньги';
        }
        elseif($_POST['notification_type'] == 'card-incoming'){
            $paysystem = 'Банковская карта';
        }

        $time = $_POST['datetime'];

        $t->addPayment(1, $_POST['amount'], $currency, $time, $paysystem, $_POST['sender'], $_POST['sha1_hash'],0);

//        $file = fopen('log.txt', 'a');
//        foreach ($_REQUEST as $key => $val)
//        {
//            fwrite($file, $key . ' => ' . $val . "\n");
//        }
//        fclose($file);
   }    
}
?>