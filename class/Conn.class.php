<?php

class Conn {

    private $Host = "localhost";
    private $User = "root";
    private $Pass = "";
    private $Dbsa = "bd_rems";
    private $Server = "mysql:host=localhost;dbname=bd_rems";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
    protected $con;

    public function openConn() {
        try {
            $this->con = new PDO($this->Server, $this->User, $this->Pass, $this->options);
            return $this->con;
        } catch (PDOException $e) {
            echo "Problema de conexão : " . $e->getMessage();
        }
    }

    public function closeConnection() {

        $this->con = null;
    }

}

?>
