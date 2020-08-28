<?
//Здесь собраны пути и статический текст сайта который можно будет перевести на любой другой язык по возможности
session_start();

$root = $_SERVER['DOCUMENT_ROOT'];
$way = array(
//    Меню пользователя
    'profile_user'=>'/profile',
    'admin_panel'=>'/admin',
//    Контроллеры
    'auth'=>'/controllers/auth.php',
    'registr'=>'/controllers/registr.php',
    'exit'=>'/controllers/exit.php',
//    Модели
    'class_user'=>$root.'/models/user.php',
    'class_bill'=>$root.'/models/bill.php',
    'class_category'=>$root.'/models/category.php',
    'class_event'=>$root.'/models/event.php',
    'class_team'=>$root.'/models/team.php',
    'class_bet'=>$root.'/models/bet.php',
    'class_transaction'=>$root.'/models/transaction.php',
    'class_statistic'=>$root.'/models/statistic.php',
//    Представления
    'template'=>$root.'/views/template.php',
    'nav'=>$root.'/views/navigation/nav.php',
    'login'=>$root.'/views/navigation/nav_auth.php',
    'entered'=>$root.'/views/navigation/nav_login.php',
    'article'=>$root.'/views/article.php',
    'profile'=>$root.'/views/user.php',
    'footer'=>$root.'/views/footer.php',
    'match'=>$root.'/views/match.php',
    'event'=>$root.'/views/event.php',
    'user_data'=>$root.'/views/profile/my_profile.php',
    'balance'=>$root.'/views/profile/balance.php',
    'withdraw'=>$root.'/views/profile/withdraw.php',
    'replenish'=>$root.'/views/profile/replenish.php',
    'payments'=>$root.'/views/profile/history_payment.php',
    'bets'=>$root.'/views/profile/history_bet.php',
    'modal_match'=>$root.'/views/modal/modal_match.php',
    'modal_event'=>$root.'/views/modal/modal_event.php',
    'error'=>$root.'/views/error.php',
    
    'url_home'=>'/',
    'url_term_use'=>'/?page=term_use.php',
    'url_about'=>'/?page=about.php',
    'url_feedback'=>'/?page=feedback.php',
    'url_rule_bet'=>'/?page=rules_bet.php',
    
    'webmoney'=>'https://www.webmoney.ru/',
    'paypal'=>'https://www.paypal.com/',
    'YM'=>'https://money.yandex.ru/',
//    Локализация
    'russian'=>$root.'/locale/russian.php',
//    Подключаемые модули
//    В представлении
    'css_bootstrap'=>'/vendors/css/bootstrap.css',
    'css_style'=>'/views/css/style.css',
    'css_enter'=>'/views/css/enter.css',
    'css_fa'=>'/vendors/font-awesome/css/font-awesome.min.css',
    'js_jquery'=>'/vendors/js/jquery-3.3.1.min.js',
    'js_bootstrap'=>'/vendors/js/bootstrap.min.js',
    'js_popper'=>'/vendors/js/popper.min.js',
    'js_script'=>'/views/js/script.js',
    'js_modal'=>'/views/js/modal_wind.js',
    'js_authorization'=>'/views/js/authorization.js',
//

);

$db = array(
    'db_host'=>'localhost',
    'db_user'=>'root',
    'db_pass'=>'',
    'db_name'=>'heliloop_bet',
);

$paysystem = array(
    'paypal'=>'views/paysystem/block_pay.php',
    'webmoney'=>'views/paysystem/block_pay.php',
    'YM'=>'views/paysystem/yandexmoney.php',
);
?>