<?
class Statistic
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
    
    public function getTotalUsers(){
        $query = "SELECT count(id) count FROM `users`";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row;
    }
    
    public function getTotalBets(){
        $query = "SELECT SUM(T.c) count FROM (
        SELECT COUNT(*) AS c FROM transaction WHERE time >= DATE_SUB(now(), INTERVAL 1 month)
        UNION
        SELECT COUNT(*) AS c FROM betting_on_event WHERE time >= DATE_SUB(now(), INTERVAL 1 month)) T";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row;
    }
    
    public function getTotalProfit(){
        $query = "SELECT (b.team_l_money+b.team_r_money)-sum(t.count*t.ratio) as count FROM bets b, transaction t, winner w WHERE b.date > date_sub(CURRENT_DATE, INTERVAL 1 month) and b.status='Завершён' and t.bet_id=b.id and w.winner=t.team_id GROUP BY b.id";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row;
    }
    
    public function getNewUsers(){
        $query = "SELECT count(id) count FROM `users` WHERE time_register >= DATE_SUB(now(), INTERVAL 1 month)";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row;
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