<?php

class Team
{
    private $id;
    private $id_category;
    private $name;
    private $description;
    private $icon;
    private $db;
    
    public function __construct()
    {
        $this->connectdb();
    }

    public function __destruct()
    {
        $this->db = null;
    }
    
    public function getCategory($id){
        $query = "select * from category where id = $id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if ($row) {
            return $row;
        }
        return false;
    }
    
    public function getTeam($name, $id_category){
        $query = "select id from team where name = :name and id_category = :category limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":name" => $name,
                ":category" => $id_category
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["id"];
    }
    
    public function getTeamsSelect($event_id){
        $query = "SELECT t.id,t.name FROM event e, team t, event_team et WHERE e.id=$event_id and e.id = et.event_id and t.id=et.team_id order by name asc";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }
    
    public function getTeams(){
        $query = "select id, name from team order by name asc";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }

    public function addTeam($name, $id_category, $icon=null, $description=null){
        $result = $this->getTeam($name, $id_category);
        if($result == true){
            $have_team = true;
            $query = "update team set id_category=:category, name=:name, description=:description, icon=:icon where id=".$result;
        }
        else{
            $query = "insert into team (id_category, name, description, icon) values (:category, :name, :description, :icon)";
        }
        
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
        
        if($have_team){
            return false;
        }
        return $result;
    }
    
    public function addCategory($name){
        $query = "select * from category where name = :name limit 1";
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
?>