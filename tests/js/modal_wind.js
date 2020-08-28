function plus(element, count){
    $(element).val(Number($(element).val())+count);
    if(element == '#count_money'){
        $('#count').text($(element).val())
        win_cash()
    }else{
        $('#count_ev').text($(element).val())
        win_cash_event()
    }
}

//Для модального окна ивента
$('#count_money_ev').on({'change':win_cash_event, 'keyup':win_cash_event});
    
function win_cash_event(){
    var cash = $('#count_money_ev').val();
    $('#count_ev').text(cash);
    var rate = $('#ev_rate_bet').text();
    $('#rate_ev').text(rate);
    var eval = cash*$('#rate_ev').text();
    $('#eval_ev').text(eval.toFixed(2));
}
    
$('#event-data').on('show.bs.modal', function (event) {
    $('article').addClass('blur')
    $('footer').addClass('blur')
    var button = $(event.relatedTarget)
    var event = '#event'+button.data('event')
    var rate = button.data('rate')
    if(rate >= 10){ rate = Number(rate).toFixed() }
    var team = '.team'+button.data('team')
    
    var modal = $(this)
    
    modal.find('#event_id').val(button.data('event'))
    modal.find('#team_id').val(button.data('team'))
    
    modal.find('#ev_event_bet').text($(event+' .event_name').html())
    modal.find('#ev_category_bet').text($(event+' .category_name').html())
    modal.find('#ev_event_bet').text($(event+' .event_name').html())
    modal.find('#ev_icon_bet').attr('src',$(event+' .icon_name').attr('src'))
    modal.find('#ev_icon_bet').attr('alt',$(event+' .icon_name').attr('alt'))
    date = $(event+' .date_for_modal').val().split('-')
    modal.find('#ev_time_bet').text(date[2]+'-'+date[1]+'-'+date[0])
    
    modal.find('#ev_team_bet').text($(team+' p').text())
    modal.find('#ev_rate_bet').text(rate)
    if($(team+' img').attr('src') == ''){
        modal.find('.img-team').attr('src','icon/no avatar.png');
    }
    else{
        modal.find('.img-team').attr('src',$(team+' img').attr('src'));
    }
})
                    
$('#event-data').on('hide.bs.modal', function (event) {
    $('article').removeClass('blur')
    $('footer').removeClass('blur')
    $('#count_money_ev').val(null)
})
    
$('#make_bet_event').on('click', function(){
    var cash = $('#event-data input[name=bet]').val();
    if(cash == ''){
        alert('Установите сумму'); return;
    }
    var event_id = $('#event_id').val();
    var team_id = $('#team_id').val();
    
    $.ajax({
        url: '/controllers/make_bet_event.php',
        data: 'cash=' + cash +'&event_id=' + event_id +'&team_id=' + team_id,
        type: 'POST',
        success: function(data){
            alert(data)
            $('#person_money').text(Number($('#person_money').text())-cash)
        },
        error: function () {
            alert('Ошибка!');
        }
    });
})

//Для модального окна матча
$('input:radio[name=rate]').change(function(){
    $('#rate').text($('input:radio[name=rate]:checked').val());
    win_cash();
});
    
$('#count_money').on({'change':win_cash, 'keyup':win_cash});
    
function win_cash(){
    var cash = $('#count_money').val();
    $('#count').text(cash);
    var rate = $('input:radio[name=rate]:checked').val();
    $('#rate').text(rate);
    var eval = cash*$('#rate').text();
    $('#eval').text(eval.toFixed(2));
}

$('#match-data').on('show.bs.modal', function (event) {
    $('article').addClass('blur')
    $('footer').addClass('blur')
    var button = $(event.relatedTarget)
    var match = '#'+button.data('match')
    var rate = button.data('rate')
    
    var modal = $(this)
    modal.find('.left-rate').html('<input type="radio" name="rate" id="rate_l" autocomplete="off">'+$(match+' .rate_l').html());
    modal.find('.right-rate').html('<input type="radio" name="rate" id="rate_r" autocomplete="off">'+$(match+' .rate_r').html());
    
    modal.find('#info_category').text($(match+' .category').html());
    modal.find('#info_event').text($(match+' .text-event b').html());
    modal.find('.datetime-match').text($(match+' .time_bet').html());
    modal.find('.team-left').text($(match+' .left_team p').html());
    if($(match+' .left_team img').attr('src') == ''){
        modal.find('.img-left').attr('src','icon/no avatar.png');
    }
    else{
        modal.find('.img-left').attr('src',$(match+' .left_team img').attr('src'));
    }
    modal.find('.team-right').text($(match+' .right_team p').html());
    if($(match+' .right_team img').attr('src') == ''){
        modal.find('.img-right').attr('src','icon/no avatar.png');
    }
    else{
        modal.find('.img-right').attr('src',$(match+' .right_team img').attr('src'));
    }
    modal.find('#match_id').html(match.substr(1,5)+' '+match[0]+match.substr(6));
    
    if(rate == 'left'){
        modal.find('#rate_l').attr('checked',true);
        modal.find('#rate_r').attr('checked',false);
        modal.find('.left-rate').addClass('active');
        modal.find('.right-rate').removeClass('active');
    }
    else if(rate == 'right'){
        modal.find('#rate_l').attr('checked',false);
        modal.find('#rate_r').attr('checked',true);
        modal.find('.left-rate').removeClass('active');
        modal.find('.right-rate').addClass('active');
    }
    else if(rate == 'win'){
        $('#make_bet').addClass('disabled');
        modal.find('.left-rate').addClass('disabled').addClass('font-weight-bold');
        modal.find('.right-rate').addClass('disabled');
        modal.find('.datetime-match').text('Завершён');
    }
    else if(rate == 'lose'){
        $('#make_bet').addClass('disabled');
        modal.find('.left-rate').addClass('disabled');
        modal.find('.right-rate').addClass('disabled').addClass('font-weight-bold');
        modal.find('.datetime-match').text('Завершён');
    }
    else if(rate == 'cancel'){
        $('#make_bet').addClass('disabled');
        modal.find('.left-rate').addClass('disabled');
        modal.find('.right-rate').addClass('disabled');
        modal.find('.datetime-match').text('Отменён');
        
    }
    modal.find('#rate_r').val($(match+' .rate_r').html());
    modal.find('#rate_l').val($(match+' .rate_l').html());
    modal.find('#rate').text($('input:radio[name=rate]:checked').val());
});
    
$('#match-data').on('hide.bs.modal', function (event) {
    $('.nav-point.nav-item.nav-link.active').click()
    $('article').removeClass('blur')
    $('footer').removeClass('blur')
    var button = $(event.relatedTarget)
    var match = '#'+button.data('match')
    
    var modal = $(this)
    modal.find('.left-rate').empty();
    modal.find('.right-rate').empty();
    modal.find('.left-rate').removeClass('disabled');
    modal.find('.right-rate').removeClass('disabled');
    modal.find('.left-rate').removeClass('active');
    modal.find('.right-rate').removeClass('active');
    $('#make_bet').removeClass('disabled');
    $('#count_money').val(null)
})
    
$('#make_bet').on('click', function(){
    var cash = $('#match-data input[name=bet]').val();
    if(cash == ''){
        alert('Установите сумму'); return;
    }
    var bet_id = $('#match_id').text();
    bet_id = bet_id.substr(7);
    var how_team = $('#match-data input:radio[name=rate]:checked').attr('id');
    if(how_team == "rate_l"){
        team = $('.team-left').text()
        rate = $('#match-data input:radio[name=rate]:checked').val()
    }
    else if(how_team == "rate_r"){
        team = $('.team-right').text()
        rate = $('#match-data input:radio[name=rate]:checked').val()
    }
    var category = $('#match'+bet_id+' .category').html();
    $.ajax({
        url: '/controllers/make_bet.php',
        data: 'cash=' + cash +'&bet=' + bet_id +'&team=' + team +'&category=' + category + '&how_team=' + how_team + '&rate=' + rate,
        type: 'POST',
        success: function(data){
            alert(data)
            if(data == 'Ставка успешно сделана'){
                $('#person_money').text(Number($('#person_money').text())-cash)
            }
        },
        error: function () {
            alert('Ошибка!');
        }
    });
})