//$( document ).ready(function() {
//    $('#auth_button').click(function(){
    function test_auth(){
        var login = $('#a_login').val();
        var password = $('#a_password').val();

        if(!login){
            $('#a_login').addClass('is-invalid');
            $('#a_login').after('<div class="invalid-feedback">Введите электронную почту</div>');
            return false;
        }

        if(!password){
            $('#a_password').addClass('is-invalid');
            $('#a_password').after('<div class="invalid-feedback">Введите пароль</div>');
            return false;
        }
        return true;
    }
//        $.ajax({
//            url: './auth.php',
//            data: 'login=' + login +'&password=' + password,
//            type: 'POST',
//            success: function(data){
//                switch(data){  
//                    case 'email': 
//                        $('#a_login').addClass('is-invalid');
//                        $('#a_login').after('<div class="invalid-feedback">Пароль не совпадает</div>');
//                        break;
//                    case 'password': 
//                        $('#a_password').addClass('is-invalid');
//                        $('#a_password').after('<div class="invalid-feedback">Пароль не совпадает</div>');
//                        break;
//                    case false: 
//                        $('#registration').after('Ошибка регистрации');
//                        break;
//                    default:
//                        $('div.modal-backdrop.fade.show').remove();
//                        document.getElementById('sys_enter').innerHTML = data;
//                }
//            },
//            error: function () {
//                alert('Ошибка!');
//            }
//        });
//    })
//});

//$( document ).ready(function() {
//    $('#reg_button').click(function(){
    function test_reg(){
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm = $('#confirm').val();

        if(!name){
            $('#name').addClass('is-invalid');
            $('#name').after('<div class="invalid-feedback">Введите имя</div>');
            return false;
        }

        if(!email){
            $('#email').addClass('is-invalid');
            $('#email').after('<div class="invalid-feedback">Введите электронную почту</div>');
            return false;
        }

        if(!password){
            $('#password').addClass('is-invalid');
            $('#password').after('<div class="invalid-feedback">Введите пароль</div>');
            return false;
        }

        if(!confirm){
            $('#confirm').addClass('is-invalid');
            $('#confirm').after('<div class="invalid-feedback">Введите пароль повторно</div>');
            return false;
        }

        if(password != confirm){
            $('#confirm').addClass('is-invalid');
            $('#confirm').after('<div class="invalid-feedback">Пароль не совпадает</div>');
            return false;
        }
        return true;
    }

//        $.ajax({
//            url: './registr.php',
//            data: 'name=' + name + '&email=' + email + '&password=' + password+ '&confirm=' + confirm,
//            type: 'POST',
//            success: function(data){
//                switch(data){
//                    case 'name': 
//                        $('#name').addClass('is-invalid');
//                        $('#name').after('<div class="invalid-feedback">Пароль не совпадает</div>');
//                        break;
//                    case 'email': 
//                        $('#email').addClass('is-invalid');
//                        $('#email').after('<div class="invalid-feedback">Пароль не совпадает</div>');
//                        break;
//                    case 'password': 
//                        $('#password').addClass('is-invalid');
//                        $('#password').after('<div class="invalid-feedback">Пароль не совпадает</div>');
//                        break;
//                    case 'confirm': 
//                        $('#confirm').addClass('is-invalid');
//                        $('#confirm').after('<div class="invalid-feedback">Пароль не совпадает</div>');
//                        break;
//                    case 'do_no_match': 
//                        $('#confirm').addClass('is-invalid');
//                        $('#confirm').after('<div class="invalid-feedback">Пароль не совпадает</div>');
//                        break;
//                    case false: 
//                        $('#registration').after('Ошибка регистрации');
//                        break;
//                    default:
//                        document.getElementById('sys_enter').innerHTML = data;
//                        $('div.modal-backdrop.fade.show').remove();
//                }
//            },
//            error: function () {
//                alert('Ошибка!');
//            }
//        });
//    })
//});

//$( document ).ready(function() {
//    $('#exit').click(function(){
//        $.ajax({
//            url: './exit.php',
//            type: 'POST',
//            success: function(data){
//                document.getElementById("sys_enter").innerHTML = data;
//            },
//            error: function () {
//                alert('Ошибка!');
//            }
//        });
//    })
//});