<?
class Bill
{
    private $id;
    private $currency;
    private $db;
    private $count;

    public function __construct()
    {
        $this->connectdb();
    }

    public function __destruct()
    {
        $this->db = null;
    }
    
    public function getBills($id){
        $query = "select * from bills where id_user = :id";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":id" => $id
            )
        );
        if (!$sth) {
            return false;
        }
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