<?

class Transaction
{
    private $id;
    private $user_id;
    private $bet_id;
    private $team_id;
    private $currency;
    private $count;
    private $ip;
    private $time;
    private $status;
    private $db;
    
    public function __construct()
    {
        $this->connectdb();
    }

    public function __destruct()
    {
        $this->db = null;
    }
    
    private function query_execution($query){
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
    
    public function getPayments($user_id){
        $query = "select * from payment where user_id=".$user_id;
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }
    
    public function getTransactions($user_id){
        $query = "
        select id, type, timestamp, ip, count, winner, team_id, date, time, team, category, event, status, ratio, team_l_rate, team_r_rate, team_l, team_r
        from ((select t.id, 'xm' as type, t.time as timestamp, t.ip, t.count, w.winner, t.team_id, b.date, b.time, team.name as team, c.name as category, e.name as event, t.status, t.ratio, b.team_l_rate, b.team_r_rate, b.team_l, b.team_r
        from transaction as t, winner as w, bets as b, team, category as c, event as e
        where t.user_id=$user_id and w.id=b.id and t.bet_id=w.id and team.id=t.team_id and e.id=b.id_event and c.id=e.id_category)
        UNION
        (select be.id, 'xe' as type, be.time as timestamp, be.ip, be.count, tc.winner, be.winner_id, e.date, '' as time, t.name as team, c.name as category, e.name as event, e.status, et.ratio, '' as team_l_rate, '' as team_r_rate, '' as team_l, '' as team_r
        from event e, event_team et, totalCash tc, betting_on_event be, team t, category c
        where be.user_id=$user_id and be.event_id=e.id and tc.id=e.id and et.event_id=e.id and et.team_id=be.winner_id and t.id=et.team_id and c.id=e.id_category)) transaction
        order by timestamp desc";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth) {
            return false;
        }
        return $sth;
    }
    
    public function getTeam($category, $name){
        $query = "select id from team where name = :name and id_category = (select id from category where name = :category limit 1) limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":name" => $name,
                ":category" => $category
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["id"];
    }
    
    public function update($bet_id, $cash, $user_id, $how_team, $status, $currency='RUB'){
        if($how_team == 'rate_r'){
            $how = 'team_r_money';
            $query = "update bills as bl, bets as bt 
            set bl.count = bl.count - :cash, bt.team_r_money = bt.team_r_money + :cash ";
        } 
        elseif($how_team == 'rate_l'){
            $how = 'team_l_money';
            $query = "update bills as bl, bets as bt 
            set bl.count = bl.count - :cash, bt.team_l_money = bt.team_l_money + :cash ";
        }
        if($status == 'В ожидании'){
            $query .= ", bt.team_r_rate = IF(
                (team_r_money + team_l_money)*0.95/team_r_money > 13, 13, IF(
                    (team_r_money + team_l_money)*0.95/team_r_money < 1.01, 1.01,(team_r_money + team_l_money)*0.95/team_r_money)),
            bt.team_l_rate = IF(
                (team_r_money + team_l_money)*0.95/(team_l_money) >13 , 13, IF(
                    (team_r_money + team_l_money)*0.95/(team_l_money) < 1.01, 1.01,(team_r_money + team_l_money)*0.95/(team_l_money))) ";
        }elseif($status == 'Live'){
            $query .= ", bt.team_r_rate = IF(
                (team_r_money + team_l_money)*0.9/team_r_money > 13, 13, IF(
                    (team_r_money + team_l_money)*0.9/team_r_money < 1.01, 1.01,(team_r_money + team_l_money)*0.9/team_r_money)),
            bt.team_l_rate = IF(
                (team_r_money + team_l_money)*0.9/(team_l_money) >13 , 13, IF(
                    (team_r_money + team_l_money)*0.9/(team_l_money) < 1.01, 1.01,(team_r_money + team_l_money)*0.9/(team_l_money))) ";
        }
        
        $query .= "where bl.id_user=:user_id and bl.currency=:currency and bt.id=:bet_id";
        
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':bet_id' => $bet_id,
                    ':user_id' => $user_id,
                    ':cash' => $cash,
                    ':currency' => $currency,
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

    public function add($cash, $bet_id, $user_id, $team_id, $ip, $rate, $status='default', $currency='RUB'){
        if($status == 'Live' or $status == 'В ожидании' or $status == 'default'){
            $query = "insert into transaction (user_id, bet_id, team_id, currency, count, ip, status, ratio) values ($user_id, $bet_id, $team_id, '$currency', $cash, '$ip', '$status', $rate)";

            return $this->query_execution($query);
            
        }
        echo "Что-то пошло не так";
        return false;
    }
    
    public function addBetOnEvent($count, $event_id, $team_id, $user_id, $ip, $currency='default'){
        $query = "insert into betting_on_event (event_id, user_id, winner_id, currency, count, ip) values ($event_id, $user_id,  $team_id, $currency, $count, '$ip')";
        return $this->query_execution($query);
    }
    
    public function updateBetOnEvent($count, $event_id, $team_id, $user_id){
        $query="UPDATE event_team et, totalCash tc, bills b SET et.count = et.count+$count, tc.count = tc.count+$count, b.count = b.count - $count WHERE et.event_id=$event_id and et.team_id = $team_id and tc.id = $event_id and b.id_user = $user_id";
        $this->query_execution($query);
        
        $query="UPDATE event_team et, totalCash tc SET et.ratio = if(et.count = 0 or tc.count*0.95/et.count > 99,99,if(tc.count*0.95/et.count < 1.01,1.01,tc.count*0.95/et.count)) WHERE et.event_id=$event_id and tc.id = $event_id";
        return $this->query_execution($query);
    }
    
    public function addPayment($user_id, $amount, $currency, $datetime, $paysystem, $sender, $sha1_hash, $unaccepted){
        $query="insert into payment (user_id, count, currency, sender, time, status, paysystem, sha1_hash) values ($user_id, '$amount', '$currency', '$sender', '$datetime', $unaccepted, '$paysystem', '$sha1_hash')";
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