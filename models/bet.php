<?

class Bet
{
    private $id;
    private $id_category;
    private $id_event;
    private $id_team1;
    private $id_team2;
    private $id_team1_money;
    private $id_team2_money;
    private $id_team1_rate;
    private $id_team2_rate;
    private $time;
    private $translation;
    private $db;
    
    public function __construct()
    {
        $this->connectdb();
    }

    public function __destruct()
    {
        $this->db = null;
    }
    
    public function query_execution($query){
        $sth = $this->db->prepare($query);
        try {
            $this->db->beginTransaction();
            $result = $sth->execute();
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        } 
        return $result;
    }
    
    public function gets(){
        $query="SELECT b.id, b.date, b.time, c.name as category, e.name as event, t1.id as left_id, t1.name as left_team, t1.icon as left_icon, t2.id as right_id, t2.name as right_team, t2.icon as right_icon, b.team_l_rate, b.team_r_rate, b.translation, b.status, w.winner FROM bets b, event e, category c, team t1, team t2, winner w WHERE b.id_event=e.id and b.team_l=t1.id and b.team_r=t2.id and e.id_category=c.id and w.id=b.id ORDER BY b.date ASC, b.time ASC";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }
    
    public function getr($id){
        $query="SELECT b.id, b.date, b.time, c.name as category, e.name as event, t1.id as left_id, t1.name as left_team, t1.icon as left_icon, t2.id as right_id, t2.name as right_team, t2.icon as right_icon, b.team_l_rate, b.team_r_rate, b.translation, b.status, w.winner FROM bets b, event e, category c, team t1, team t2, winner w WHERE b.id_event=e.id and b.team_l=t1.id and b.team_r=t2.id and e.id_category=c.id and w.id=b.id and b.id=$id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row;
    }
    
    public function getTeams($event_id){
        $query="select t.name, t.id from event_team et, team t where et.event_id=$event_id and et.team_id=t.id";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }
    
    public function getEvents(){
        $query="SELECT e.id, e.date, c.name as category, e.name, e.status, tc.winner FROM event e, category c, totalCash tc WHERE e.id_category=c.id and tc.id=e.id ORDER BY e.date DESC";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }
    
    public function getStatus($id){
        $query = "select status from bets where id = $id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["status"];
    }
    
    public function add($id_event, $time, $date, $team1, $rate1, $team2, $rate2, $translation = null) {
        if($translation){ $video=$translation.'&autoplay=false'; }
        if(!$rate1){ $rate1=1.9; $rate2=1.9;}
        
        $query = "select id from bets where id_event=$id_event and date='$date' and time='$time' and team_l=$team1 and team_r=$team2 limit 1";
        
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        
        if($row){
            $query = "update bets set id_event=:id_event, date=:date, time=:time, team_l=:team_l, team_r=:team_r, team_l_rate=:rate_l, team_r_rate=:rate_r, translation=:translation where id=".$row['id'];
        }
        else{
            $query = "insert into bets (id_event, date, time, team_l, team_r, team_l_rate, team_r_rate, translation)
            values (:id_event, :date, :time, :team_l, :team_r, :rate_l, :rate_r, :translation)";
        }
        
        $sth = $this->db->prepare($query);
        
        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':id_event' => $id_event,
                    ':date' => $date,
                    ':time' => $time,
                    ':team_l' => $team1,
                    ':team_r' => $team2,
                    ':rate_l' => $rate1,
                    ':rate_r' => $rate2,
                    ':translation' => $video,
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }
    
    public function addEvent($name, $id_category){
        $query = "select id from event where name = :name and id_category = :category limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":name" => $name,
                ":category" => $id_category
            )
        );
        $row = $sth->fetch();
        if ($row) {
            return $row["id"];
        }
        
        $query = "insert into event (id_category, name) values (:category, :name)";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':name' => $name,
                    ':category' => $id_category
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }
    
    public function addCategory($name){
        $query = "select id from category where name = :name limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":name" => $name
            )
        );
        $row = $sth->fetch();
        if ($row) {
            return $row["id"];
        }
        
        $query = "insert into category (name) values (:name)";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':name' => $name
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }
    
    public function addTeam($name, $id_category, $icon=null, $description=null){
        $query = "select id from team where name = :name and id_category = :category limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":name" => $name,
                ":category" => $id_category
            )
        );
        $row = $sth->fetch();
        if ($row) {
            return $row["id"];
        }
        
        $query = "insert into team (id_category, name, description, icon) values (:category, :name, :description, :icon)";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':name' => $name,
                    ':category' => $id_category,
                    ':description' => $description,
                    ':icon' => $icon
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }
    
    public function changeMatch($id, $status, $winner, $translation){
        if($translation){ $video=$translation.'&autoplay=false'; }
        
        $query="select b.id, w.winner, b.status from bets b, winner w where w.id=b.id and b.id=$id and b.status='$status' and b.translation='$video' and w.winner=$winner limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row=$sth->fetch();
        if($row){ 
            return false;
        }
        
        if($status=='Завершён'){
            $query="update winner w set w.winner=$winner where w.id=$id";
            $this->query_execution($query);
            
            $query="update bets b set b.status='$status' where b.id=$id";
        }elseif($status=='Live'){
            $query="update winner w set w.winner=null where w.id=$id";
            $this->query_execution($query);
            
            $query="update bets b set b.status='$status', b.translation='$video', team_r_rate = IF((team_r_money + team_l_money)*0.9/team_r_money > 13, 13, IF((team_r_money + team_l_money)*0.9/team_r_money < 1.01, 1.01,(team_r_money + team_l_money)*0.9/team_r_money)), team_l_rate = IF((team_r_money + team_l_money)*0.9/(team_l_money) >13 , 13, IF((team_r_money + team_l_money)*0.9/(team_l_money) < 1.01, 1.01,(team_r_money + team_l_money)*0.9/(team_l_money))) where b.id=$id";
        }else{
            $query="update winner w set w.winner=null where w.id=$id";
            $this->query_execution($query);
            
            $query="update bets b set b.status='$status', b.translation='$video' where b.id=$id";
        }
        
        return $this->query_execution($query);
    }
    
    public function changeEvent($id, $winner){
        if($winner){
            $query="update totalCash tc, event e set e.status=3, tc.winner=$winner where e.id=$id and e.id=tc.id";
            return $this->query_execution($query);
        }
        else{
            echo 'Вы ничего не изменили;';
            return true;
        }
    }
    
    public function live(){
        $query = "(SELECT b.id, b.date, b.time, c.name as category, e.name as tournament, t1.name as left_team, t1.icon as left_icon, t2.name as right_team, t2.icon as right_icon, b.team_l_rate, b.team_r_rate, b.translation, b.status FROM bets b, event e, category c, team t1, team t2 WHERE b.id_event=e.id and b.team_l=t1.id and b.team_r=t2.id and e.id_category=c.id and b.status='Live' ORDER BY b.date DESC, b.time DESC)
        union
        (SELECT b.id, b.date, b.time, c.name as category, e.name as tournament, t1.name as left_team, t1.icon as left_icon, t2.name as right_team, t2.icon as right_icon, b.team_l_rate, b.team_r_rate, b.translation, b.status FROM bets b, event e, category c, team t1, team t2 WHERE b.id_event=e.id and b.team_l=t1.id and b.team_r=t2.id and e.id_category=c.id and b.status='Завершён' ORDER BY b.date DESC, b.time DESC)";

        $sth = $this->db->prepare($query);
        $sth->execute();
        
        return $sth;
    }
    
    public function ordinar(){
        $query = "SELECT b.id, b.date, b.time, c.name as category, e.name as tournament, t1.id as left_id, t1.name as left_team, t1.icon as left_icon, t2.id as right_id, t2.name as right_team, t2.icon as right_icon, b.team_l_rate, b.team_r_rate, b.translation, b.status, w.winner FROM bets b, event e, category c, team t1, team t2, winner w WHERE b.id_event=e.id and b.team_l=t1.id and b.team_r=t2.id and e.id_category=c.id and w.id=b.id ORDER BY b.status, b.date ASC, b.time ASC";

        $sth = $this->db->prepare($query);
        $sth->execute();
        
        return $sth;
    }
    
    public function express(){
        $query = "SELECT b.id, b.date, b.time, c.name as category, e.name as tournament, t1.name as left_team, t1.icon as left_icon, t2.name as right_team, t2.icon as right_icon, b.team_l_rate, b.team_r_rate, b.translation, b.status FROM bets b, event e, category c, team t1, team t2 WHERE b.id_event=e.id and b.team_l=t1.id and b.team_r=t2.id and e.id_category=c.id and b.status='В ожидании' ORDER BY b.date DESC, b.time DESC";

        $sth = $this->db->prepare($query);
        $sth->execute();
        
        return $sth;
    }
    
    public function events(){
        $query = "SELECT e.id, e.name, e.icon, c.name as category, e.date, e.status, tc.winner FROM event e, category c, totalCash tc WHERE e.id_category=c.id and e.id=tc.id and e.date > date_sub(curdate(), Interval 14 day) ORDER BY e.date DESC";

        $sth = $this->db->prepare($query);
        $sth->execute();
        
        return $sth;
    }
    
    public function translation(){
        $query = "select * from bets where status = 'Live' and translation <> ''";

        $sth = $this->db->prepare($query);
        $sth->execute();
        
        return $sth;
    }
    
    public function teams($event_id){
        $query = "select t.id, t.name, t.icon, et.ratio  from team t, event_team et where t.id=et.team_id and et.event_id=$event_id";

        $sth = $this->db->prepare($query);
        $sth->execute();
        
        return $sth;
    }

    public function connectdb()
    {
        global $db;
        try {
            $this->db = new \pdo("mysql:host=".$db['db_host'].";dbname=".$db['db_name'], $db['db_user'], $db['db_pass']);
        } catch (\pdoexception $e) {
            echo "database error: " . $e->getmessage();
            die();
        }
        $this->db->query('set names utf8');

        return $this;
    }
    
    public function close()
    {
        $this->db = null;
    }
}