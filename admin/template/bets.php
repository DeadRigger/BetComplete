<?
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";

require_once $way['class_user'];
$user = new User();
if($user->getData($_SESSION['id'])['status'] == 'Администратор'){
    
}
else{
    echo "<meta http-equiv = 'refresh' content = '0, URL=\"/\"' >"; 
    return;
}
?>
<!-- Form Bet -->
<form id="form-bet" method="post" class="form-horizontal form-box remove-margin">
    <!-- Form Header -->
    <h4 class="form-box-header">Создание матча</h4>

    <!-- Form Content -->
    <div class="form-box-content" style="display: none;">
        <div class="form-group">
            <label class="control-label col-md-2" for="val_category">Дисциплина *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                    <select id="val_category" name="val_category" class="form-control select-category" size="1" required>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="val_event">Событие *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gamepad fa-fw"></i></span>
                    <select id="val_event" name="val_event" class="form-control select-event"></select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="val_date">Дата *</label>
            <div class="col-md-2">
                <div class="input-group date input-datepicker" data-date="04-30-2013" data-date-format="mm-dd-yyyy">
                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                    <input type="date" id="val_date" min="<? echo date('Y-m-d');?>" name="val_date" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="val_time">Время *</label>
            <div class="col-md-1">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
                    <input type="time" id="val_time" name="val_time" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="val_team1">Левая команда *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                    <select id="val_team1" name="val_team1" class="form-control select-team"></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <span class="input-group-addon">K1</span>
                    <input type="text" id="val_rate_l" name="val_rate_l" value="" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="val_team2">Правая команда *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                    <select id="val_team2" name="val_team2" class="form-control select-team"></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <span class="input-group-addon">K2</span>
                    <input type="text" id="val_rate_r" name="val_rate_r" value="" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="val_video">Трансляция</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
                    <input type="text" id="val_video" name="val_video" value="" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-md-10 col-md-offset-2">
                <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Сбросить</button>
                <a id="add-bet" class="btn btn-success"><i class="fa fa-check"></i> Создать</a>
            </div>
        </div>
    </div>
    <!-- END Form Content -->
</form>
<!-- END Form Bet -->

<!-- Form Category -->
<form id="form-category" method="post" class="form-horizontal form-box remove-margin">
    <!-- Form Header -->
    <h4 class="form-box-header">Добавление дисциплины</h4>

    <!-- Form Content -->
    <div class="form-box-content" style="display: none;">
        <div class="form-group">
            <label class="control-label col-md-2" for="cat_category">Дисциплина *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                    <input type="text" id="cat_category" name="cat_category" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="cat_description">Описание</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text fa-fw"></i></span>
                    <input type="text" id="cat_description" name="cat_description" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-md-10 col-md-offset-2">
                <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Сбросить</button>
                <a id="add-category" class="btn btn-success"><i class="fa fa-check"></i> Добавить</a>
            </div>
        </div>
    </div>
    <!-- END Form Content -->
</form>
<!-- END Form Category -->

<!-- Form Event -->
<form id="form-event" method="post" class="form-horizontal form-box remove-margin">
    <!-- Form Header -->
    <h4 class="form-box-header">Добавление события</h4>

    <!-- Form Content -->
    <div class="form-box-content" style="display: none;">
        <div class="form-group">
            <label class="control-label col-md-2" for="ev_category">Дисциплина *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                    <select id="ev_category" name="ev_category" class="form-control select-category" size="1" required>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="ev_event">Событие *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gamepad fa-fw"></i></span>
                    <input type="text" id="ev_event" name="ev_event" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="ev_date">Дата *</label>
            <div class="col-md-2">
                <div class="input-group date input-datepicker" data-date="16-02-2018" data-date-format="dd-mm-yyyy">
                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                    <input type="date" id="ev_date" name="ev_date" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="ev_team">Команды *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                    <select id="ev_team" name="ev_team" class="form-control select-team" multiple>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="ev_description">Описание</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text fa-fw"></i></span>
                    <input type="text" id="ev_description" name="ev_description" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-md-10 col-md-offset-2">
                <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Сбросить</button>
                <a id="add-event" class="btn btn-success"><i class="fa fa-check"></i> Добавить</a>
            </div>
        </div>
    </div>
    <!-- END Form Content -->
</form>
<!-- END Form Event -->

<!-- Form Team -->
<form id="form-team" method="post" class="form-horizontal form-box remove-margin">
    <!-- Form Header -->
    <h4 class="form-box-header">Добавить команду</h4>

    <!-- Form Content -->
    <div class="form-box-content" style="display: none;">
        <div class="form-group">
            <label class="control-label col-md-2" for="t_category">Категория *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                    <select id="t_category" name="t_category" class="form-control select-category" size="1" required>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="t_team">Команда *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                    <input type="text" id="t_team" name="t_team" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="t_icon">Эмблема *</label>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file fa-fw"></i></span>
                    <input type="file" id="t_icon" name="t_icon" class="form-control-file">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="t_description">Описание</label>
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text fa-fw"></i></span>
                    <input type="text" id="t_description" name="t_description" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-md-10 col-md-offset-2">
                <button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Сбросить</button>
                <a id="add-team" class="btn btn-success"><i class="fa fa-check"></i> Добавить</a>
            </div>
        </div>
    </div>
    <!-- END Form Content -->
</form>
<!-- END Form Team -->

<script>
$( document ).ready(function() {
    $('.form-box-header').click(function(){
        $(this).siblings('.form-box-content').slideToggle(300);
    });
    
    $.ajax({
        url: 'select.php',
        data: 'select=category',
        type: 'POST',
        success: function(data){
            $('.select-category').empty().html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            system_alert(errorThrown);
        }
    });

    $.ajax({
        url: 'select.php',
        data: 'select=event',
        type: 'POST',
        success: function(data){
            $('.select-event').empty().html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            system_alert(errorThrown);
        }
    });

    $.ajax({
        url: 'select.php',
        data: 'select=team',
        type: 'POST',
        success: function(data){
            $('.select-team').empty().html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            system_alert(errorThrown);
        }
    });
    
    $('#add-team').click(function(){
        var name = $('#t_team').val();
        var category = $('#t_category').val();
        var way = $('#t_icon').val().split('\\');
        var icon = way[way.length-1];
        var description = $('#t_description').val();

        $.ajax({
            url: 'hendlers/addTeam.php',
            data: 'team=' + name +'&category=' + category +'&icon=' + icon +'&description=' + description,
            type: 'POST',
            success: function(data){
                system_alert(data);
                $('#t_team').val('');
            },
            error: function () {
                system_alert('Ошибка!');
            }
        });
    })
    
    $('#add-event').click(function(){
        var name = $('#ev_event').val()
        var category = $('#ev_category').val()
        var date = $('#ev_date').val()
        var description = $('#ev_description').val()
        var teams = $('#ev_team').val()

        $.ajax({
            url: 'hendlers/addEvent.php',
            data: 'name=' + name +'&category=' + category +'&date=' + date +'&description=' + description +'&teams=' + teams,
            type: 'POST',
            success: function(data){
                system_alert(data);
            },
            error: function () {
                system_alert('Ошибка!');
            }
        });
    })
    
    $('#add-category').click(function(){
        var category = $('#cat_category').val();
        var description = $('#cat_description').val();

        $.ajax({
            url: 'hendlers/addCategory.php',
            data: 'name=' + category +'&description=' + description,
            type: 'POST',
            success: function(data){
                system_alert(data);
            },
            error: function () {
                system_alert('Ошибка!');
            }
        });
    })
    
    $('#add-bet').click(function(){
        var event = $('#val_event').val();
        var category = $('#val_category').val();
        var date = $('#val_date').val();
        var time = $('#val_time').val();
        var team1 = $('#val_team1').val();
        var rate1 = $('#val_rate_l').val();
        var team2 = $('#val_team2').val();
        var rate2 = $('#val_rate_r').val();
        var video = $('#val_video').val();

        $.ajax({
            url: 'hendlers/addBets.php',
            data: 'event=' + event +'&category=' + category +'&date=' + date +'&time=' + time +'&team1=' + team1 +'&rate1=' + rate1 + '&team2=' + team2 + '&rate2=' + rate2 +'&video=' + video,
            type: 'POST',
            success: function(data){
                system_alert(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                system_alert(errorThrown);
            }
        });
    })
});
    
$('#form-event .form-box-header').click(function(){
    $('#ev_team').multiselect({
        numberDisplayed: 4,
        maxHeight: 150,
        buttonWidth: '300px',
        enableCaseInsensitiveFiltering: true,
    });
})
    
$('#val_category').on('change',function(){
    $.ajax({
        url: 'select.php',
        data: 'select=event&category='+$(this).val(),
        type: 'POST',
        success: function(data){
            $('#val_event').empty().html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            system_alert(errorThrown);
        }
    });
})
    
$('#val_event').on('change',function(){
    $.ajax({
        url: 'select.php',
        data: 'select=team&event='+$(this).val(),
        type: 'POST',
        success: function(data){
            $('#val_team1').empty().html(data);
            $('#val_team2').empty().html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            system_alert(errorThrown);
        }
    });
})
    
</script>