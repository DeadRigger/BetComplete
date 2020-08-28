<? session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/config/config.php";
require_once $way['class_user'];

$user = new User();
$user->connectdb($db);
if($user->getData($_SESSION['id'])['status'] == 'Администратор'){
    $result = '';
    if($_POST['select'] == 'category'){
        require_once $way['class_category'];
        
        $ctg = new Category();
        $ctg->connectdb($db);
        $sth = $ctg->getCategories();
        $result .= '<option value="#">Выберите категорию</option>';
        while($row=$sth->fetch()){
            $result .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        $ctg->close();
    }
    elseif($_POST['select'] == 'event'){
        require_once $way['class_event'];
        
        $ev = new Event();
        $ev->connectdb($db);
        
        if($_POST['category']) $sth = $ev->getEventsSelect($_POST['category']);
        else $sth = $ev->getEvents();
            
        $result .= '<option value="#">Выберите событие</option>';
        while($row=$sth->fetch()){
            $result .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        $ev->close();
    }
    elseif($_POST['select'] == 'team'){
        require_once $way['class_team'];
        
        $t = new Team();
        $t->connectdb($db);
        
        if($_POST['event']) $sth = $t->getTeamsSelect($_POST['event']);
        else $sth = $t->getTeams();
        
        $result .= '<option value="#">Выберите команду</option>';
        while($row=$sth->fetch()){
            $result .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        $t->close();
    }
    echo $result;
}
?>