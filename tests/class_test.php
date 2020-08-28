<?
class Bet
{
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
    
    public function gets($tables, $select='*', $where = NULL){
        $query = "select $select from $tables $where";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if($sth) return $sth;
        return false;
    }
    
    public function add($date, $time, $event_id, $team_l, $team_r){
        $query = "insert into bets (date, time, id_event, team_l, team_r, team_l_rate, team_r_rate) values ('$date', '$time', $event_id, $team_l, $team_r, 1.9, 1.9)";
        return $this->query_execution($query);
    }
    
    public function addEvent($name, $id_category, $icon = NULL){
        $query = "select id from event where name = '$name' and id_category = $id_category limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if ($row) {
            return $row["id"];
        }
        
        $query = "insert into event (id_category, name, icon) values ($id_category, '$name', '$icon')";
        return $this->query_execution($query);
    }
    
    public function addTeam($name, $id_category, $icon=null, $description=null){
        $query = "select id from team where name = \"$name\" and id_category = $id_category limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if ($row) {
            return $row["id"];
        }
        
        $query = "insert into team (id_category, name, description, icon) values ($id_category, \"$name\", \"$description\", \"$icon\")";
        return $this->query_execution($query);
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