<? session_start(); 
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

require_once $way['class_user'];

//Проверка на логин и пароль в сессиях
$user = new User();
if($user->isAuthorized()){
    $u = $user->getData($_SESSION['id']);
}
else{
    echo 'Вы не зарегистрированы';
    return;
}
?>

<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
    <input type="hidden" name="receiver" value="410015167951598">
    <input type="hidden" name="quickpay-form" value="shop">
    <input type="hidden" name="label" value="<? echo $u['email'].' '.$u['id'];?>">
    <input type="hidden" name="successURL" value="http://betcomlete.h1n.ru/">
    <div class="form-group" style="width: 100%">
        <div class="col-md-10 my-2"> 
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="paymentType" value="PC" autocomplete="off" checked><img src="img/yamoney.png">
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="paymentType" value="AC" autocomplete="off"><img src="img/visa_mc.png">
                </label>
            </div>
        </div>
        <div class="col-md-10 my-2">
            <div class="input-group">
                <input type="number" name="sum" placeholder="Сумма пополнения" data-type="number" class="form-control">
            </div>
        </div>
        <div class="col-md-10 my-2">
            <div class="input-group rounded text-warning">
                <button class="btn btn-default col-md-12"><b>Оплатить</b></button>
            </div>
        </div>
    </div>
</form>