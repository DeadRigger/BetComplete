<?
class User
{
    private $id;
    private $username;
    private $db;
    private $user_id;

    private $is_authorized = false;
    
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
    
    public function getUsers($status){
        $query = "select * from users where status = '$status'";
        $sth = $this->db->prepare($query);
        $sth->execute();
        if (!$sth){
            return false;
        }
        return $sth;
    }
    
    public function getData($id){
        $query = "select * from users where id = $id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if (!$row){
            return false;
        }
        return $row;
    }
    
    public function getName($id)
    {
        $query = "select name from users where id = :id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":id" => $id
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["name"];
    }

    public function isAuthorized()
    {
        if (!empty($_SESSION["id"])) {
            return (bool) $_SESSION["id"];
        }
        return false;
    }
    
    public function entered(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;
        
        $query = "select ip, time, user_id from enter where time > CURRENT_DATE and ip='$ip' and user_id=".$_SESSION["id"]." limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $row = $sth->fetch();
        if(!$row){
            if (!empty($_SESSION["id"])) {
                $query = "insert into enter (user_id, ip) values (".$_SESSION["id"].",'".$ip."')";
                $sth = $this->db->prepare($query);
                $this->query_execution($sth);
                return (bool) $_SESSION["id"];
            }
            $query = "insert into enter (ip) values ('".$ip."')";
            $sth = $this->db->prepare($query);
            $this->query_execution($sth);
            return false;
        }
        else{ 
            return $this->isAuthorized();
        }
    }

    public function passwordHash($password, $salt = null, $iterations = 10)
    {
        $salt || $salt = uniqid();
        $hash = md5(md5($password . md5(sha1($salt))));

        for ($i = 0; $i < $iterations; ++$i) {
            $hash = md5(md5(sha1($hash)));
        }

        return array('hash' => $hash, 'salt' => $salt);
    }

    public function getSalt($username) {
        $query = "select salt from users where email = :username limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":username" => $username
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["salt"];
    }

    public function authorize($username, $password, $remember=false)
    {
        $query = "select id, email from users where
            email = :username and password = :password limit 1";
        $sth = $this->db->prepare($query);
        $salt = $this->getSalt($username);

        if (!$salt) {
            return false;
        }

        $hashes = $this->passwordHash($password, $salt);
        $sth->execute(
            array(
                ":username" => $username,
                ":password" => $hashes['hash'],
            )
        );
        $this->user = $sth->fetch();
        
        if (!$this->user) {
            $this->is_authorized = false;
        } else {
            $this->is_authorized = true;
            $this->user_id = $this->user['id'];
            $this->saveSession($remember);
        }

        return $this->is_authorized;
    }

    public function logout()
    {
        if (!empty($_SESSION["id"])) {
            unset($_SESSION["id"]);
        }
    }

    public function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["id"] = $this->user_id;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public function create($name, $username, $password) {
        $user_exists = $this->getSalt($username);

        if ($user_exists) {
            return false;
        }

        $hashes = $this->passwordHash($password);
        $query = "insert into users (name, email, password, salt)
            values ('$name', '$username', '".$hashes['hash']."', '".$hashes['salt']."')";
        $sth = $this->db->prepare($query);
        $this->query_execution($sth);
        
        $sth = $this->db->prepare('select id from users where email="'.$username.'" limit 1');
        $sth->execute();
        $row = $sth->fetch();
        $result = $row['id'];
        
        $query = "insert into bills (id_user) values ($result)";
        $sth = $this->db->prepare($query);
        $this->query_execution($sth);
        
        return $result;
    }
    
    public function save($id, $email, $name, $surname, $fathername, $gender, $country, $city, $address, $phone, $birthday)
    {
        $row = $this->getData($id);
        
        if($email and $email != $row['email']) $data[] = 'email="'.$email.'"';
        
        if($name and $name != $row['name']) $data[] = 'name="'.$name.'"';
        
        if($surname and $surname != $row['surname']) $data[] = 'surname="'.$surname.'"';
        
        if($fathername and $fathername != $row['fathername']) $data[] = 'fathername="'.$fathername.'"';
        
        if($country and $country != $row['country']) $data[] = 'country="'.$country.'"';
        
        if($city and $city != $row['city']) $data[] = 'city="'.$city.'"';
        
        if($address and $address != $row['address']) $data[] = 'address="'.$address.'"';
        
        if($phone and $phone != $row['phone']){
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if(count($phone) == 11) return 'Номер телефона должен содержать 11 цифр';
            else $data[] = 'phone="'.$phone.'"';
        }
        
        if($gender != 'undefined' and $gender != $row['gender']) $data[] = 'gender="'.$gender.'"';
        
        if($birthday and $birthday != $row['birthday']) $data[] = 'birthday="'.$birthday.'"';
        
        for($i=0; $i<count($data); $i++){
            if($i == 0) { 
                $set = $data[$i];
            } else{
                $set .= ','.$data[$i];
            }
        }

        if($set == true){
            $query = "update users set ".$set." where id=:id ";
            $sth = $this->db->prepare($query);

            try {
                $this->db->beginTransaction();
                $result = $sth->execute(
                    array(
                        ':id' => $id,
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
            return 'complete';
        }
        else {return 'no_change';}
        
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