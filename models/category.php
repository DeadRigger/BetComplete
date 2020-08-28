<?php

class Category
{
    private $id;
    private $name;
    private $description;
    private $db;
    
    
    public function __construct()
    {
        $this->connectdb();
    }

    public function __destruct()
    {
        $this->db = null;
    }
    
    public function getCategory($name){
        $query = "select id from category where name = :name limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":name" => $name
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["id"];
    }
    
    public function getCategories(){
        $query = "select id, name from category order by name desc";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }

    public function addCategory($name, $description = null){
        $result = $this->getCategory($name);
        if($result == true){
            $have_category = true;
            $query = "update category set name=:name, description=:description where id=".$result;
        }
        else{
            $query = "insert into category (name, description) values (:name, :description)";
        }
        
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':name' => $name,
                    ':description' => $description
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

        if($have_category){
            return false;
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