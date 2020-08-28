<?

class Event
{
    private $id;
    private $id_category;
    private $name;
    private $description;
    private $start_date;
    private $db;
    
    public function __construct()
    {
        $this->connectdb();
    }

    public function __destruct()
    {
        $this->db = null;
    }
    
    
    public function query_execution($sth){
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
    
    public function getEvent($name, $id_category, $date){
        $query = "select id from event where name = '$name' and id_category = $id_category and date = '$date' limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["id"];
    }
    
    public function getEventsSelect($category_id){
        $query = "select * from event where status=1 and id_category='$category_id' order by name desc";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }
    
    public function getEvents(){
        $query = "select id, name from event order by name desc";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }

    public function addEvent($name, $id_category, $date, $description=null){
        $result = $this->getEvent($name, $id_category, $date);
        if($result == true){
            return false;
        }
        
        $query = "insert into event (id_category, name, description, date) values ($id_category, '$name', '$description', '$date')";
        $sth = $this->db->prepare($query);

        if($this->query_execution($sth)){
            $event_id = $this->getEvent($name, $id_category, $date);
            $query = "insert into totalCash (id) values ($event_id)";
            $sth = $this->db->prepare($query);
            $this->query_execution($sth);
                
            return $event_id;
        }
        return false;
    }
    
    public function addTeams_event($teams, $id){
        $query = 'insert into event_team (event_id, team_id) values ';
        $cnt = count($teams);
        for($i=0; $i < $cnt; $i++){
            if($i!=$cnt-1) $query .= "($id, $teams[$i]),";
            else $query .= "($id, $teams[$i])";
        }
        
        $sth = $this->db->prepare($query);
        $this->query_execution($sth);
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