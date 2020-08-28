<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

//Выбор языка
require_once $way['russian'];

if($user_data){
    
}
else{
    $error=401;
    include $way['error'];
    return;
}
?>

<h2><? echo $lang['my_data'];?></h2>
<hr>
<form method="post" class="form-horizontal form-box remove-margin">
    <!-- Form Content -->
    <!-- 1 row -->
    <div class="row">
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="email"><? echo $lang['email'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="<? echo $user_data['email'];?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="country"><? echo $lang['country'];?></label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" id="country" name="country" placeholder="<? echo $user_data['country'];?>" class="form-control">
            </div>
        </div>
    </div>
    </div>
    
    <!-- 2 row -->
    <div class="row">
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="name"><? echo $lang['name'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" id="name" name="name" placeholder="<? echo $user_data['name'];?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="city"><? echo $lang['city'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" id="city" name="city" placeholder="<? echo $user_data['city'];?>" class="form-control">
            </div>
        </div>
    </div>
    </div>
    
    <!-- 3 row -->
    <div class="row">
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="surname"><? echo $lang['surname'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" id="surname" name="surname" placeholder="<? echo $user_data['surname'];?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="address"><? echo $lang['address'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" id="address" name="address" placeholder="<? echo $user_data['address'];?>" class="form-control">
            </div>
        </div>
    </div>
    </div>
    
    <!-- 4 row -->
    <div class="row">
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="fathername"><? echo $lang['fathername'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" id="fathername" name="fathername" placeholder="<? echo $user_data['fathername'];?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="phone"><? echo $lang['phone'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="tel" id="phone" name="phone" placeholder="<? if($user_data['phone']){ echo $user_data['phone'];}else{ echo '9 (999) 999-99-99';}?>" class="form-control">
            </div>
        </div>
    </div>
    </div>
    
    <!-- 5 row -->
    <div class="row">
    <div class="form-group col-md-6">
        <div class="col-md-12 my-3">
            <label class="control-label"><? echo $lang['gender'];?>:</label>
            <label class="form-check-inline">
              <? if($user_data['gender'] == 'male') $check_m=' checked';
                 else $check_f=' checked';?>
              <input class="form-check-input" type="radio" name="gender" id="male" value="male"<? echo $check_m;?>> <? echo $lang['male'];?>
            </label>
            <label class="form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="female"<? echo $check_f;?>> <? echo $lang['female'];?>
            </label>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label class="control-label col-md-12" for="date"><? echo $lang['birthday'];?>:</label>
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" id="date" name="date" placeholder="<? echo date('d.m.Y',strtotime($user_data['birthday']));?>" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>
        </div>
    </div>
    </div>
    
    <!-- 6 row -->
    <div class="row">
    <div class="form-group form-actions col-md-12">
        <div class="col-md-10 col-md-offset-2">
            <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> <? echo $lang['reset'];?></button>
            <a id="save" class="btn btn-success text-white" onclick="save()"><i class="fa fa-check"></i> <? echo $lang['save'];?></a>
        </div>
    </div>
    </div>
    <!-- END Form Content -->
</form>


<script>
function save(){
    var email = $('#email').val()
    var name = $('#name').val()
    var surname = $('#surname').val()
    var fathername = $('#fathername').val()
    var gender = $('input[name="gender"]:checked').val()
    var country = $('#country').val()
    var city = $('#city').val()
    var address = $('#address').val()
    var phone = $('#phone').val()
    var birthday = $('#date').val()

    $.ajax({
        url: '/controllers/save_user.php',
        data: 'email=' + email +'&name=' + name +'&surname=' + surname +'&fathername=' + fathername +'&gender=' + gender +'&country=' + country +'&city=' + city +'&address=' + address +'&phone=' + phone +'&birthday=' + birthday,
        type: 'POST',
        success: function(data){
            if(data == 'complete') system_alert('Ваши данные изменены', 'success')
            else if(data == 'no_change') system_alert('Вы не изменили ни одного поля', 'warning')
        },
        error: function () {
            system_alert('Ошибка!', 'danger')
        }
    })
}
</script>