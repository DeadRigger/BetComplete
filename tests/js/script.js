function exit(){
    $.ajax({
        url: 'exit.php',
        type: 'POST',
        success: function(data){
            document.getElementById("sys_enter").innerHTML = data;
        },
        error: function () {
            alert('Ошибка!');
        }
    });
}

//Переключение между вкладками в личном кабинете
function ajax_profile(page){
    $.ajax({
        url: 'profile.php',
        type: 'POST',
        data: "page="+page,
        success: function(data){
            document.getElementById("main-content").innerHTML = data;
        },
        error: function () {
            alert('Ошибка!');
        }
    });
}

//Переключение между вкладками на главной странице
function ajax_navtab(page){
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: "nav="+page,
        success: function(data){
            document.getElementById("nav-"+page).innerHTML = data;
        },
        error: function () {
            alert('Ошибка!');
        }
    });
}

$( document ).ready(function() {
    $('#my_profile').click(function(){
        ajax_profile('profile')
    });

    $('#balance').click(function(){
        ajax_profile('balance')
    });

    $('#withdraw').click(function(){
        ajax_profile('withdraw')
    });

    $('#replenish').click(function(){
        ajax_profile('replenish')
    });

    $('#history_payment').click(function(){
        ajax_profile('payment')
    });

    $('#history_bet').click(function(){
        ajax_profile('bet')
    });

    $('#nav-live-tab').click(function(){
        ajax_navtab('live')
    });

    $('#nav-ordinar-tab').click(function(){
        ajax_navtab('ordinar')
    });

    $('#nav-express-tab').click(function(){
        ajax_navtab('express')
    });

    $('#nav-event-tab').click(function(){
        ajax_navtab('event')
    });
});

$('#spinner').click(function() {
    $('#spinner i').addClass('fa-spin')
    $('.nav-point.nav-item.nav-link.active').click()
    setTimeout(stopSpin, 3000)
});

function stopSpin(){
    $('#spinner i').removeClass('fa-spin')
}

function toggleEvent(element){
    $(element).find('.event-content').toggle(300)
}

function go_event(){
    $('#nav-event-tab').click()
    $('.match').unbind()
}