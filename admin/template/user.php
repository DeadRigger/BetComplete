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
    <script>
    $(function(){ 
      $("#tabs a").click(function(e){
        e.preventDefault();
        $(this).tab('show');
      });
    });
    </script>
    <!-- Users Tile -->
    <div class="dash-tile dash-tile-2x remove-margin">
        <div class="dash-tile-header">
            <i class="fa fa-user"></i> Пользователи
        </div>
        <div class="dash-tile-content">
            <div class="dash-tile-content-inner-fluid">
                <!-- Users tabs links -->
                <ul id="tabs" class="nav nav-tabs" data-toggle="tabs">
                    <li class="active"><a href="#tabs-admin">Админы</a></li>
                    <li><a href="#tabs-mods">Модеры</a></li>
                    <li><a href="#tabs-users">Пользователи</a></li>
                    <li><a href="#tabs-no_confirm">Неактивированные</a></li>
                </ul>
                <!-- END Users tabs links -->

                <!-- User tabs content -->
                <div class="tab-content">
                    <!-- Admins Tab -->
                    <div id="tabs-admin" class="tab-pane fade in active">
                        <ul class="thumbnails clearfix remove-margin" data-toggle="gallery-options">
                            <? 
                            $users = $user->getUsers('Администратор');
                            while($row = $users->fetch()) { 
                            ?>
                            <li>
                                <div class="thumbnails-options">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="thumbnail">
                                    <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                </a>
                                <a href="javascript:void(0)" class="thumbnail thumbnail-borderless text-center"><? echo $row['name']; ?></a>
                            </li>
                            <? } ?>
                        </ul>
                    </div>
                    <!-- END Admins Tab -->

                    <!-- Mods Tab -->
                    <div id="tabs-mods" class="tab-pane fade">
                        <ul class="thumbnails clearfix remove-margin" data-toggle="gallery-options">
                            <? 
                            $users = $user->getUsers('Модератор');
                            while($row = $users->fetch()) { 
                            ?>
                            <li>
                                <div class="thumbnails-options">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="thumbnail">
                                    <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                </a>
                                <a href="javascript:void(0)" class="thumbnail thumbnail-borderless text-center"><? echo $row['name']; ?></a>
                            </li>
                            <? } ?>
                        </ul>
                    </div>
                    <!-- END Mods Tab -->

                    <!-- Users Tab -->
                    <div id="tabs-users" class="tab-pane fade">
                        <ul class="thumbnails clearfix remove-margin" data-toggle="gallery-options">
                            <? 
                            $users = $user->getUsers('Пользователь');
                            while($row = $users->fetch()) { 
                            ?>
                            <li>
                                <div class="thumbnails-options">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="thumbnail">
                                    <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                </a>
                                <a href="javascript:void(0)" class="thumbnail thumbnail-borderless text-center"><? echo $row['name']; ?></a>
                            </li>
                            <? } ?>
                        </ul>
                    </div>
                    <!-- END Users Tab -->

                    <!-- Users Tab -->
                    <div id="tabs-no_confirm" class="tab-pane fade">
                        <ul class="thumbnails clearfix remove-margin" data-toggle="gallery-options">
                            <? 
                            $users = $user->getUsers('Неактивирован');
                            while($row = $users->fetch()) { 
                            ?>
                            <li>
                                <div class="thumbnails-options">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="thumbnail">
                                    <img src="img/placeholders/image_light_64x64.png" alt="fakeimg">
                                </a>
                                <a href="javascript:void(0)" class="thumbnail thumbnail-borderless text-center"><? echo $row['name']; ?></a>
                            </li>
                            <? } ?>
                        </ul>
                    </div>
                    <!-- END Users Tab -->
                </div>
                <!-- END User tabs content -->
            </div>
        </div>
    </div>
    <!-- END Users Tile -->